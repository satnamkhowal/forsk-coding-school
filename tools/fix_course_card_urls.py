#!/usr/bin/env python3
import csv
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


def norm(s: str) -> str:
    return s.lower().strip().replace("|", "l")


def is_old_url(s: str) -> bool:
    t = norm(s)
    if "forskcodingschool" in t:
        return False
    compact = re.sub(r"[^a-z0-9]", "", t)
    if compact in {"forskin", "wwwforskin", "httpforskin", "httpsforskin"}:
        return True
    return bool(re.search(r"(?:www\.)?forsk[\.,]?in(?:\b|[/])", t))


def extract_boxes(data, scale=1.0, y_offset=0):
    boxes = []
    texts = data.get("text", [])
    for i, txt in enumerate(texts):
        if not txt or not txt.strip():
            continue
        if is_old_url(txt):
            boxes.append((
                int(data["left"][i] / scale),
                int(data["top"][i] / scale) + y_offset,
                max(1, int(data["width"][i] / scale)),
                max(1, int(data["height"][i] / scale)),
                txt,
            ))
    if boxes:
        return boxes

    # Catch OCR splitting the URL into adjacent tokens such as "forsk" + ".in".
    for i in range(len(texts) - 1):
        a, b = texts[i].strip(), texts[i + 1].strip()
        if not a or not b:
            continue
        same_line = (
            data["block_num"][i] == data["block_num"][i + 1]
            and data["line_num"][i] == data["line_num"][i + 1]
        )
        if not same_line or not is_old_url(a + b):
            continue
        x1 = data["left"][i]
        y1 = min(data["top"][i], data["top"][i + 1])
        x2 = data["left"][i + 1] + data["width"][i + 1]
        y2 = max(data["top"][i] + data["height"][i], data["top"][i + 1] + data["height"][i + 1])
        boxes.append((int(x1/scale), int(y1/scale)+y_offset, max(1,int((x2-x1)/scale)), max(1,int((y2-y1)/scale)), a+b))
    return boxes


def ocr_boxes(img: Image.Image):
    # Fast pass at native resolution.
    try:
        data = pytesseract.image_to_data(img, output_type=Output.DICT, config="--psm 11", timeout=12)
        boxes = extract_boxes(data)
        if boxes:
            return boxes
    except Exception as exc:
        print("native OCR warning:", exc)

    # Stronger footer pass; the URL is normally in the lower part of these cards.
    y0 = int(img.height * 0.50)
    crop = img.crop((0, y0, img.width, img.height))
    scale = 2
    crop = crop.resize((crop.width * scale, crop.height * scale), Image.Resampling.LANCZOS)
    try:
        data = pytesseract.image_to_data(crop, output_type=Output.DICT, config="--psm 11", timeout=12)
        boxes = extract_boxes(data, scale=scale, y_offset=y0)
        if boxes:
            return boxes
    except Exception as exc:
        print("footer OCR warning:", exc)
    return []


def estimate_fg(arr, x, y, w, h):
    H, W = arr.shape[:2]
    pad = max(3, int(h * 0.6))
    outer = arr[max(0,y-pad):min(H,y+h+pad), max(0,x-pad):min(W,x+w+pad)].reshape(-1,3)
    inner = arr[max(0,y):min(H,y+h), max(0,x):min(W,x+w)].reshape(-1,3)
    bg = np.median(outer, axis=0) if len(outer) else np.array([255,255,255])
    if not len(inner):
        return (25,25,25)
    dist = np.linalg.norm(inner.astype(float)-bg.astype(float), axis=1)
    take = max(1, int(len(inner)*0.25))
    fg = np.median(inner[np.argsort(dist)[-take:]], axis=0)
    return tuple(int(v) for v in fg)


def fit_font(draw, target, box_h, max_w):
    size = max(9, int(box_h * 1.05))
    while size >= 7:
        font = ImageFont.truetype(FONT_PATH, size)
        b = draw.textbbox((0,0), target, font=font)
        tw, th = b[2]-b[0], b[3]-b[1]
        if tw <= max_w and th <= max(12, int(box_h*1.35)):
            return font, tw, th
        size -= 1
    font = ImageFont.truetype(FONT_PATH, 7)
    b = draw.textbbox((0,0), target, font=font)
    return font, b[2]-b[0], b[3]-b[1]


def replace_domain(path: Path):
    img = Image.open(path).convert("RGB")
    boxes = ocr_boxes(img)
    if not boxes:
        return False, "old URL not detected"

    arr = np.array(img)
    bgr = cv2.cvtColor(arr, cv2.COLOR_RGB2BGR)
    mask = np.zeros(bgr.shape[:2], np.uint8)
    specs = []
    for x,y,w,h,txt in boxes:
        fg = estimate_fg(arr,x,y,w,h)
        gx = max(2,int(h*.30)); gy=max(2,int(h*.20))
        cv2.rectangle(mask,(max(0,x-gx),max(0,y-gy)),(min(img.width-1,x+w+gx),min(img.height-1,y+h+gy)),255,-1)
        specs.append((x,y,w,h,fg,txt))

    clean = cv2.inpaint(bgr,mask,3,cv2.INPAINT_TELEA)
    out = Image.fromarray(cv2.cvtColor(clean,cv2.COLOR_BGR2RGB))
    draw = ImageDraw.Draw(out)
    for x,y,w,h,fg,txt in specs:
        max_w = int(min(img.width*.58,max(w*4.0,img.width*.25)))
        font,tw,th = fit_font(draw,TARGET,h,max_w)
        cx=x+w/2
        tx=int(max(2,min(img.width-tw-2,cx-tw/2)))
        ty=int(max(2,min(img.height-th-2,y+h/2-th/2)))
        draw.text((tx,ty),TARGET,font=font,fill=fg)
    out.save(path,"WEBP",quality=94,method=6)
    return True, f"replaced {len(specs)} occurrence(s): " + ", ".join(s[-1] for s in specs)


def commit_one(path: Path):
    subprocess.run(["git","add",str(path)],check=True)
    if subprocess.run(["git","diff","--cached","--quiet"]).returncode == 0:
        return ""
    subprocess.run(["git","commit","-m",f"fix: correct website URL on {path.name}"],check=True)
    push=subprocess.run(["git","push","origin","HEAD:main"],text=True,capture_output=True)
    if push.returncode != 0:
        subprocess.run(["git","pull","--rebase","origin","main"],check=True)
        subprocess.run(["git","push","origin","HEAD:main"],check=True)
    return subprocess.check_output(["git","rev-parse","HEAD"],text=True).strip()


def main():
    cards=sorted(p for p in ROOT.iterdir() if p.is_file() and is_course_card(p))
    print(f"Found {len(cards)} candidate course cards",flush=True)
    rows=[]
    for i,path in enumerate(cards,1):
        print(f"[{i}/{len(cards)}] {path.name}",flush=True)
        try:
            changed,note=replace_domain(path)
            sha=commit_one(path) if changed else ""
            status="fixed" if changed else "skipped"
            print(f"  {status.upper()}: {note} {sha}",flush=True)
            rows.append([str(path),status,note,sha])
        except Exception as exc:
            print(f"  ERROR: {exc!r}",flush=True)
            rows.append([str(path),"error",repr(exc),""])

    with REPORT.open("w",newline="",encoding="utf-8") as f:
        w=csv.writer(f); w.writerow(["path","status","note","commit_sha"]); w.writerows(rows)
    subprocess.run(["git","add",str(REPORT)],check=True)
    if subprocess.run(["git","diff","--cached","--quiet"]).returncode != 0:
        subprocess.run(["git","commit","-m","chore: add course card URL fix report"],check=True)
        subprocess.run(["git","push","origin","HEAD:main"],check=True)
    fixed=sum(r[1]=="fixed" for r in rows); skipped=sum(r[1]=="skipped" for r in rows); errors=sum(r[1]=="error" for r in rows)
    print(f"SUMMARY fixed={fixed} skipped={skipped} errors={errors} total={len(rows)}",flush=True)
    if errors:
        raise SystemExit(2)

if __name__=="__main__":
    main()
