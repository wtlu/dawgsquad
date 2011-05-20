#!/bin/bash
# 
# Author	: Greg Brandt
# Purpose	: Pulls and updates repository nightly @ 12:10AM (daily build)
# Notes		: Runs at 12:10AM so tests have a chance to run @ 12:00AM

cd /var/www/html/dawgsquad/
sudo hg pull			# get new stuff
sudo hg merge			# merge if necessary
sudo hg update			# updates to most recent build

