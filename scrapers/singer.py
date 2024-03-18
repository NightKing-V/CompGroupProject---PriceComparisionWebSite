import requests
import time
import json
from bs4 import BeautifulSoup


def getSingerData(url,category=None):

    offer_list = []

    headers = {
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.79 Safari/537.36'
    }

    response = requests.get(url, headers=headers, verify=False)
    soup = BeautifulSoup(response.content, 'html.parser')

    # Get Title
    product_container = soup.find_all('div', class_='product-item')
    for product in product_container:
        item = product.find('img')
        try:
            title = item['title']
        except:
            title = None
        try:
            image = item['src']
        except:
            image = None
        try:
            original_price = product.find('div',class_='original-price').text.split()[1]
        except:
            original_price = None
        try:
            selling_price = product.find('div',class_='selling-price').text.split()[1]
        except:
            selling_price = None
        try:
            link_tag = product.find('div', class_='section').find('a')
            product_url = link_tag['href']
        except:
            product_url = None


        items = {
            "image":image,
            "title":title,
            "original_price":original_price,
            "selling_price":selling_price,
            "product_url":product_url,
            "platform":"singer",
            "category":category
        }

        offer_list.append(items)

    return offer_list