#!/bin/bash

__FILE__=$(readlink -f "$0")
__DIR__=$(dirname "$__FILE__")

LOG_DIR="$__DIR__/../logs"

find "$LOG_DIR" -name '*.log' -print0 | xargs -0 rm -f

exit 0
