# 📸 Image Upload Directory

## Where to Upload Images

Upload your manga cover images to the following directories:

### Jujutsu Kaisen Images
**Location:** `public/images/jujutsu-kaisen/`

**Required Files:**
- `jujutsu-kaisen-vol-0.jpg`
- `jujutsu-kaisen-vol-1.jpg`
- `jujutsu-kaisen-vol-2.jpg`
- `jujutsu-kaisen-vol-3.jpg`
- `jujutsu-kaisen-vol-4.jpg`
- `jujutsu-kaisen-vol-5.jpg`
- `jujutsu-kaisen-vol-6.jpg`
- `jujutsu-kaisen-vol-7.jpg`
- `jujutsu-kaisen-vol-8.jpg`
- `jujutsu-kaisen-vol-9.jpg`

### Other Manga Images
You can create subdirectories for other manga series as needed:
- `public/images/one-piece/`
- `public/images/naruto/`
- etc.

## How Images Are Accessed

Images uploaded to `public/images/` are accessible via:
```
http://127.0.0.1:8000/images/jujutsu-kaisen/jujutsu-kaisen-vol-0.jpg
```

The seeder automatically prepends `/images/jujutsu-kaisen/` to the filename when saving to the database.

## File Formats Supported

- `.jpg` / `.jpeg`
- `.png`
- `.webp`

## Recommended Image Size

- Width: 400-600px
- Height: 600-800px
- Aspect Ratio: 2:3 (typical manga cover ratio)







