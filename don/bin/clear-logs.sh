#!/bin/bash

__FILE__=$(readlink -f "$0")
__DIR__=$(dirname "$__FILE__")

LOG_DIR="$__DIR__/../logs"

rm -f $LOG_DIR/*

exit 0
