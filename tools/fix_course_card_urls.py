#!/usr/bin/env python3
import csv
import os
import re
import subprocess
from pathlib import Path

import cv2
import numpy as np
import pytesseract
from PIL import Image, ImageDraw, ImageFont
from pytesseract import Output

ROOT = Path("assets/images")
TARGET = "forskcodingschool.com"
FONT_PATH = "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf"
REPORT = Path("course-card-url-fix-report.csv")


def is_course_card(path: Path) -> bool:
    n = path.name.lower()
    if not n.endswith(".webp") or "forsk-coding-school" not in n:
        return False
    return (
        "-course-jaipur-forsk-coding-school" in n
        or n.startswith("diploma-")
        or n.startswith("internship-programs-")
        or n.startswith("java-courses-")
        or n.startswith("java-interview-preparation-")
        or n.startswith("other-it-courses-")
    )


def normalize_text(s: str) -> str:
    return re.sub(r"\s+", "", s.lower()).replace("|", "l")


def looks_like_old_domain(s: str) -> bool:
    t = normalize_text(s).strip(".,;:()[]{}<>")
    return bool(re.fullmatch(r"forsk[\.,]?in", t)) or t in {"forskin", "forsk.in"}


def ocr_boxes(img: Image.Image):
    scale = 3
    big = img.resize((img.width * scale, img.height * scale), Image.Resampling.LANCZOS)
    data = pytesseract.image_to_data(big, output_type=Output.DICT, config="--psm 11")
    boxes = []
    for i, txt in enumerate(data.get("text", [])):
        if not txt or not txt.strip():
            continue
        if looks_like_old_domain(txt):
            x = int(data["left"][i] / scale)
            y = int(data["top"][i] / scale)
            w = max(1, int(data["width"][i] / scale))
            h = max(1, int(data["height"][i] / scale))
            boxes.append((x, y, w, h, txt))

    if boxes:
        return boxes

    # Fallback: combine nearby OCR tokens from the same line, catching split "forsk" + ".in".
    n = len(data.get("text", []))
    for i in range(n - 1):
        a = data["text"][i].strip()
        b = data["text"][i + 1].strip()
        if not a or not b:
            continue
        if data["block_num"][i] != data["block_num"][i + 1] or data["line_num"][i] != data["line_num"][i + 1]:
            continue
        combo = a + b
        if looks_like_old_domain(combo):
            x1 = data["left"][i]
            y1 = data["top"][i]
            x2 = data["left"][i + 1] + data["width"][i + 1]
            y2 = data["top"][i + 1] + data["height"][i + 1]
            boxes.append((int(x1/scale), int(y1/scale), max(1, int((x2-x1)/scale)), max(1, int((y2-y1)/scale)), combo))
    return boxes


def estimate_colors(arr_rgb: np.ndarray, x: int, y: int, w: int, h: int):
    H, W = arr_rgb.shape[:2]
    pad = max(4, int(h * 0.8))
    x0, y0 = max(0, x-pad), max(0, y-pad)
    x1, y1 = min(W, x+w+pad), min(H, y+h+pad)
    ring = arr_rgb[y0:y1, x0:x1].reshape(-1, 3)
    inside = arr_rgb[max(0,y):min(H,y+h), max(0,x):min(W,x+w)].reshape(-1, 3)
    if len(ring) == 0:
        bg = np.array([255,255,255], dtype=np.uint8)
    else:
        bg = np.median(ring, axis=0)
    if len(inside) == 0:
        fg = np.array([30,30,30], dtype=np.uint8)
    else:
        dist = np.linalg.norm(inside.astype(float) - bg.astype(float), axis=1)
        k = max(1, int(len(inside) * 0.25))
        idx = np.argsort(dist)[-k:]
        fg = np.median(inside[idx], axis=0)
    return tuple(int(v) for v in bg), tuple(int(v) for v in fg)


def fit_font(draw: ImageDraw.ImageDraw, target: str, box_h: int, max_w: int):
    size = max(10, int(box_h * 1.15))
    while size >= 8:
        font = ImageFont.truetype(FONT_PATH, size=size)
        bbox = draw.textbbox((0,0), target, font=font)
        tw, th = bbox[2]-bbox[0], bbox[3]-bbox[1]
        if tw <= max_w and th <= max(box_h * 1.35, 12):
            return font, tw, th
        size -= 1
    font = ImageFont.truetype(FONT_PATH, size=8)
    bbox = draw.textbbox((0,0), target, font=font)
    return font, bbox[2]-bbox[0], bbox[3]-bbox[1]


def replace_domain(path: Path):
    img = Image.open(path).convert("RGB")
    boxes = ocr_boxes(img)
    if not boxes:
        return False, "old URL not detected"

    arr_rgb = np.array(img)
    arr_bgr = cv2.cvtColor(arr_rgb, cv2.COLOR_RGB2BGR)
    mask = np.zeros(arr_bgr.shape[:2], dtype=np.uint8)
    color_specs = []

    for x, y, w, h, old_txt in boxes:
        _, fg = estimate_colors(arr_rgb, x, y, w, h)
        grow_x = max(2, int(h * 0.25))
        grow_y = max(2, int(h * 0.20))
        x0 = max(0, x-grow_x); y0 = max(0, y-grow_y)
        x1 = min(img.width-1, x+w+grow_x); y1 = min(img.height-1, y+h+grow_y)
        cv2.rectangle(mask, (x0,y0), (x1,y1), 255, thickness=-1)
        color_specs.append((x, y, w, h, fg))

    clean = cv2.inpaint(arr_bgr, mask, 3, cv2.INPAINT_TELEA)
    out = Image.fromarray(cv2.cvtColor(clean, cv2.COLOR_BGR2RGB))
    draw = ImageDraw.Draw(out)

    for x, y, w, h, fg in color_specs:
        max_w = int(min(img.width * 0.52, max(w * 3.6, img.width * 0.22)))
        font, tw, th = fit_font(draw, TARGET, h, max_w)
        cx = x + w / 2
        tx = int(max(2, min(img.width - tw - 2, cx - tw/2)))
        ty = int(max(2, min(img.height - th - 2, y + h/2 - th/2)))
        draw.text((tx, ty), TARGET, font=font, fill=fg)

    out.save(path, format="WEBP", quality=94, method=6)
    return True, f"replaced {len(boxes)} occurrence(s)"


def sh(*args, check=True):
    return subprocess.run(args, text=True, capture_output=True, check=check)


def commit_one(path: Path):
    subprocess.run(["git", "add", str(path)], check=True)
    if subprocess.run(["git", "diff", "--cached", "--quiet"]).returncode == 0:
        return None
    msg = f"fix: correct website URL on {path.name}"
    subprocess.run(["git", "commit", "-m", msg], check=True)
    # Keep main current in case another change landed while this action was running.
    push = subprocess.run(["git", "push", "origin", "HEAD:main"], text=True, capture_output=True)
    if push.returncode != 0:
        subprocess.run(["git", "pull", "--rebase", "origin", "main"], check=True)
        subprocess.run(["git", "push", "origin", "HEAD:main"], check=True)
    return subprocess.check_output(["git", "rev-parse", "HEAD"], text=True).strip()


def main():
    cards = sorted(p for p in ROOT.iterdir() if p.is_file() and is_course_card(p))
    rows = []
    fixed = 0
    print(f"Found {len(cards)} candidate course cards")
    for idx, path in enumerate(cards, start=1):
        print(f"[{idx}/{len(cards)}] {path}")
        try:
            changed, note = replace_domain(path)
            commit_sha = ""
            if changed:
                commit_sha = commit_one(path) or ""
                fixed += 1
                print(f"  FIXED: {note} commit={commit_sha}")
            else:
                print(f"  SKIPPED: {note}")
            rows.append([str(path), "fixed" if changed else "skipped", note, commit_sha])
        except Exception as exc:
            print(f"  ERROR: {exc}")
            rows.append([str(path), "error", repr(exc), ""])

    with REPORT.open("w", newline="", encoding="utf-8") as f:
        writer = csv.writer(f)
        writer.writerow(["path", "status", "note", "commit_sha"])
        writer.writerows(rows)
    subprocess.run(["git", "add", str(REPORT)], check=True)
    if subprocess.run(["git", "diff", "--cached", "--quiet"]).returncode != 0:
        subprocess.run(["git", "commit", "-m", "chore: add course card URL fix report"], check=True)
        subprocess.run(["git", "push", "origin", "HEAD:main"], check=True)

    skipped = sum(1 for r in rows if r[1] == "skipped")
    errors = sum(1 for r in rows if r[1] == "error")
    print(f"SUMMARY fixed={fixed} skipped={skipped} errors={errors} total={len(cards)}")
    if errors:
        raise SystemExit(2)


if __name__ == "__main__":
    main()
