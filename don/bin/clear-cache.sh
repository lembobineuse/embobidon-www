#!/bin/bash

__FILE__=$(readlink -f "$0")
__DIR__=$(dirname "$__FILE__")

CACHE_DIR="$__DIR__/../cache"

find "$CACHE_DIR" -mindepth 1 -type d -print0 | xargs -0 rm -rf

exit 0
