#!/bin/bash

# Customize this:
THUMB_GEOMETRY="200x200>"


# ========== Goooooooo ! ========== #

if ! hash parallel 2>/dev/null;
then
    echo "GNU Parallel not found !"
    echo "Try $ apt-get install parallel"
    exit 125
fi

if ! hash convert 2>/dev/null;
then
    echo "ImageMagick not found !"
    echo "Try $ apt-get install imagemagick"
    exit 125
fi


__FILE__=$(readlink -f "$0")
__DIR__=$(dirname "$__FILE__")

WEB_DIR="$__DIR__/../../htdocs/don"
PICS_DIR="$WEB_DIR/img/pics"

find "$PICS_DIR" -iname '*.jpg' -not -name '*_tn.jpg' -print0 \
    | parallel -0 --no-notice \
        "convert -define jpeg:size=500x180 -auto-orient -thumbnail '$THUMB_GEOMETRY' -unsharp 0x.5 {} {//}/{/.}_tn.jpg"

exit 0
