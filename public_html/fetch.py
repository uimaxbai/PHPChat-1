#!/bin/python310
# use python fetch.py to run this script

import os
import base64

my_secret = os.environ['remotemysqlpassword']
print("Decrypting password...")
decrypted = base64.b64decode(my_secret)
print("Decoding password...")
decoded = decrypted.decode()
print(decoded, "- is the password for RemoteMySQL")
