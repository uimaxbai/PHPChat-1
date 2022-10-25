# use python delete_log.py to execute this program

from os import remove
import glob

remove("log.html")
str=log
remove("log2.html")
files = glob.glob('*.html')
for file in files:
    if search("private", file):
        remove(file)
print(" All Logs have been deleted")