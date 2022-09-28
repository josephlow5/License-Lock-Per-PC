import subprocess
import requests
from urllib.parse import quote

def get_uuid() -> str:
    return subprocess.check_output('wmic csproduct get uuid').decode().split('\n')[1].strip()

def get_hdd_id() -> str:
    serials = subprocess.check_output("wmic diskdrive get Name,SerialNumber").decode().split('\n')[1:]
    for serial in serials:
        if 'DRIVE0' in serial:
            return serial.split('DRIVE0')[-1].strip()

def get_unique_id():
    return(get_uuid() + '-' + get_hdd_id())

def check():
    unique_id = get_unique_id()

    check = requests.get("http://154.38.101.248/license.php?MachineCode="+quote(unique_id))
    if check.text == "Valid!":
        return "Valid!"
    else:
        return unique_id

if check() != "Valid!":
    print("需要授权! 机器码: "+get_unique_id())
else:
    print("已获得授权! "+get_unique_id())
input()
