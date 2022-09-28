import requests
from urllib.parse import quote

def create():
    Machine_Code = input("要授权的机器码: ")
    check = requests.get("http://154.38.101.248/license.php?Key=dclicense&Create="+quote(Machine_Code))
    if "已成功授权机器" in check.text:
        print("授权成功!\n")
def delete():
    Machine_Code = input("要删除的机器码: ")
    check = requests.get("http://154.38.101.248/license.php?Key=dclicense&Delete="+quote(Machine_Code))
    if "已成功删除机器" in check.text:
        print("删除成功!\n")

        
while True:
    choice = input("按1授权,按2删除: ")
    if choice == "1":
        create()
    elif choice == "2":
        delete()
    else:
        continue

