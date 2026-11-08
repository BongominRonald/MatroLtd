import os
import shutil
from PIL import Image

def generate_favicons():
    badge_path = os.path.join('public', 'img', 'brx-emblem-web.png')
    if not os.path.exists(badge_path):
        badge_path = os.path.join('public', 'img', 'brx-emblem-nav.png')
    
    print(f"Generating favicons from badge: {badge_path}")
    im = Image.open(badge_path).convert('RGBA')
    
    # 1. Multi-resolution favicon.ico
    ico_sizes = [(16, 16), (32, 32), (48, 48), (64, 64)]
    im.save('public/favicon.ico', format='ICO', sizes=ico_sizes)
    im.save('public/img/favicon.ico', format='ICO', sizes=ico_sizes)
    print("Generated public/favicon.ico and public/img/favicon.ico")

    # 2. PNG favicons and touch icons
    for size in [16, 32, 48, 64, 128, 180, 192, 512]:
        resized = im.resize((size, size), Image.Resampling.LANCZOS)
        if size == 180:
            resized.save('public/img/apple-touch-icon.png', format='PNG', optimize=True)
            print("Generated public/img/apple-touch-icon.png")
        elif size in [16, 32, 48]:
            resized.save(f'public/img/favicon-{size}x{size}.png', format='PNG', optimize=True)
            print(f"Generated public/img/favicon-{size}x{size}.png")
        if size == 64:
            resized.save('public/img/brx-badge-favicon.png', format='PNG', optimize=True)
            resized.save('public/img/favicon.png', format='PNG', optimize=True)
            print("Generated public/img/brx-badge-favicon.png and public/img/favicon.png")

def optimize_images():
    img_dir = os.path.join('public', 'img')
    total_orig = 0
    total_opt = 0

    all_files = [os.path.join(img_dir, f) for f in os.listdir(img_dir)]
    # Also check Agrovia.jpg in public root
    if os.path.exists('public/Agrovia.jpg'):
        all_files.append('public/Agrovia.jpg')

    for filepath in all_files:
        if not os.path.isfile(filepath):
            continue
        ext = os.path.splitext(filepath)[1].lower()
        if ext not in ['.jpg', '.jpeg', '.png']:
            continue
        
        orig_size = os.path.getsize(filepath)
        total_orig += orig_size

        base_name = os.path.splitext(filepath)[0]
        webp_path = base_name + '.webp'

        try:
            im = Image.open(filepath)
            
            # Save WebP version
            if ext == '.png' and im.mode in ('RGBA', 'LA'):
                im.save(webp_path, format='WEBP', lossless=False, quality=85, method=6)
            else:
                rgb_im = im.convert('RGB')
                rgb_im.save(webp_path, format='WEBP', quality=82, method=6)
            
            webp_size = os.path.getsize(webp_path)

            # Optimize original format in-place for any direct references
            if ext == '.png':
                if 'emblem' in filepath.lower() or 'logo' in filepath.lower():
                    # Keep transparency
                    im.save(filepath, format='PNG', optimize=True)
                else:
                    # Large PNGs like product emblem (2MB) - compress down
                    im.save(filepath, format='PNG', optimize=True)
            elif ext in ['.jpg', '.jpeg']:
                rgb_im = im.convert('RGB')
                rgb_im.save(filepath, format='JPEG', optimize=True, quality=82)

            new_orig_size = os.path.getsize(filepath)
            total_opt += new_orig_size

            print(f"{os.path.basename(filepath)}: {orig_size/1024:.1f}KB -> {new_orig_size/1024:.1f}KB (WebP: {webp_size/1024:.1f}KB, -{(1 - webp_size/orig_size)*100:.1f}%)")

        except Exception as e:
            print(f"Error processing {filepath}: {e}")

    print(f"\nTotal image storage before: {total_orig/1024:.1f} KB")
    print(f"Total image storage after optimization: {total_opt/1024:.1f} KB")

def setup_font_and_lib_paths():
    # Make sure Boxicons has fonts in expected relative places
    os.makedirs('public/lib/boxicons/fonts', exist_ok=True)
    os.makedirs('public/lib/boxicons/css', exist_ok=True)
    os.makedirs('public/lib/fonts', exist_ok=True)
    
    # Copy boxicons files into css/ and fonts/
    if os.path.exists('public/lib/boxicons/boxicons.min.css'):
        shutil.copy('public/lib/boxicons/boxicons.min.css', 'public/lib/boxicons/css/boxicons.min.css')
    
    for f in ['boxicons.woff2', 'boxicons.woff', 'boxicons.ttf']:
        src = os.path.join('public/lib/boxicons/fonts', f)
        if os.path.exists(src):
            shutil.copy(src, os.path.join('public/lib/fonts', f))

    # Make sure FontAwesome has webfonts in expected relative places
    os.makedirs('public/lib/font-awesome/css', exist_ok=True)
    os.makedirs('public/lib/font-awesome/webfonts', exist_ok=True)
    if os.path.exists('public/lib/font-awesome/all.min.css'):
        shutil.copy('public/lib/font-awesome/all.min.css', 'public/lib/font-awesome/css/all.min.css')
    
    if os.path.exists('public/lib/webfonts'):
        for f in os.listdir('public/lib/webfonts'):
            shutil.copy(os.path.join('public/lib/webfonts', f), os.path.join('public/lib/font-awesome/webfonts', f))

    # Fix font CSS relative urls for Open Sans & Poppins so they use './' relative to /fonts/
    for css_file in ['public/fonts/open-sans.css', 'public/fonts/poppins.css']:
        if os.path.exists(css_file):
            with open(css_file, 'r', encoding='utf-8') as f:
                content = f.read()
            content = content.replace('/fonts/', './')
            with open(css_file, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"Updated font URLs in {css_file}")

if __name__ == '__main__':
    generate_favicons()
    optimize_images()
    setup_font_and_lib_paths()
