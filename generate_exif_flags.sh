#!/bin/bash

# Create a directory for the images
mkdir -p exif_images

# Generate images with different flags
echo "FLAG{hidden_in_plain_sight}" > exif_images/backup_log.txt
echo "FLAG{metadata_mystery}" > exif_images/system_config.txt
echo "FLAG{data_in_details}" > exif_images/error_report.txt
echo "FLAG{behind_the_scenes}" > exif_images/debug_info.txt

# Create images with hidden flags
for flag in exif_images/*.txt; do
    base=$(basename "$flag" .txt)
    # Create a simple image
    convert -size 100x100 xc:white "exif_images/${base}.jpg"
    # Add the flag to the image metadata
    exiftool -Comment="$(cat $flag)" "exif_images/${base}.jpg"
    # Remove the original text file
    rm "$flag"
done 