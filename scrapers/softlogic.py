import requests
import time
import json
from bs4 import BeautifulSoup
from urllib.parse import quote


def getSoftlogicData(url):

    offer_list = []

    headers = {
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.79 Safari/537.36'
    }

    response = requests.get(url, headers=headers)
    soup = BeautifulSoup(response.content, 'html.parser')
    cards = soup.find_all('div', class_='product_item')
    for item in cards:
        image = quote(item.find('div',class_='product_image').find('img')['src'], safe='/:')
        title = item.find('a',class_='line-clamp line-clamp-2').text
        try:
            original_price = item.find('div',class_='product_price mb-0 line-clamp line-clamp-1').find('span').text.replace("LKR","")
        except:
            original_price = "No original price"
        selling_price = item.find('div',class_='product_price').text.strip().replace("LKR","")
        itemDict = {
            "image":image,
            "title":title,
            "original_price":original_price,
            "selling_price":selling_price
        }
        offer_list.append(itemDict)
    return offer_list

data = getSoftlogicData(r"https://mysoftlogic.lk/search?search-text=rice%20cooker")
json_string = json.dumps(data, indent=2)
print(json_string)