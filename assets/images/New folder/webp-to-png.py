from PIL import Image
import os

folder = r"C:\xampp\htdocs\forsk-coding-school\assets\images\New folder\jpg"

for filename in os.listdir(folder):
    if filename.lower().endswith(".webp"):
        webp_path = os.path.join(folder, filename)

        # Create PNG filename
        png_filename = os.path.splitext(filename)[0] + ".png"
        png_path = os.path.join(folder, png_filename)

        # Convert WebP to PNG
        image = Image.open(webp_path)
        image.save(png_path, "PNG")

        print(f"Converted: {filename} -> {png_filename}")

print("Done!")
