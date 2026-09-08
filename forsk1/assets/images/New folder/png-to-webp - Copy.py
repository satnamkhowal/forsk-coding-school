from PIL import Image
import os

folder = r"C:\xampp\htdocs\forsk-coding-school\assets\images\New folder\New folder"

for filename in os.listdir(folder):
    if filename.lower().endswith(".png"):
        png_path = os.path.join(folder, filename)

        # Change .png extension to .webp
        webp_filename = os.path.splitext(filename)[0] + ".webp"
        webp_path = os.path.join(folder, webp_filename)

        # Convert PNG to WebP
        image = Image.open(png_path)
        image.save(webp_path, "WEBP", quality=85)

        print(f"Converted: {filename} → {webp_filename}")

print("Done!")
