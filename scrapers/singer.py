import requests
import time
import json
from bs4 import BeautifulSoup


def getSingerData(url):

    offer_list = []

    headers = {
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.79 Safari/537.36'
    }

    response = requests.get(url, headers=headers)
    soup = BeautifulSoup(response.content, 'html.parser')

    # Get Title
    product_container = soup.find_all('div', class_='product-item')
    for product in product_container:
        item = product.find('img')
        try:
            title = item['title']
        except:
            title = "No Title"
        try:
            image = item['src']
        except:
            image = "No image"
        try:
            original_price = product.find('div',class_='original-price').text.split()[1]
        except:
            original_price = "No original price"
        try:
            selling_price = product.find('div',class_='selling-price').text.split()[1]
        except:
            selling_price = "No selling Price"

        items = {
            "image":image,
            "title":title,
            "original_price":original_price,
            "selling_price":selling_price
        }

        offer_list.append(items)

    return offer_list

# data = getSingerData("https://www.singersl.com/products/appliances/refrigerator?page=1")
# json_string = json.dumps(data, indent=2)
# print(json_string)