<?php

$path = 'uploads\1739604570-473832579_9247142672012420_4778458476970169484_n.jpg';

if (file_exists($path)) {
    unlink($path);
}