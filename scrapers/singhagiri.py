import json
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options

chrome_options = Options()
chrome_options.add_argument('--headless')
chrome_options.add_argument('--no-sandbox')
chrome_options.add_argument('log-level=3')
chrome_options.add_experimental_option('excludeSwitches', ['enable-logging']) 
chrome_options.add_argument("user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36")
chrome_options.add_argument("accept-language=en-US,en;q=0.9")
chrome_options.add_argument("disable-blink-features=AutomationControlled")
chrome_options.headless = True


def getSinghagiriData(url,category):

    driver = webdriver.Chrome(options=chrome_options)
    driver.get(url)

    offer_list = []

    elements = driver.find_elements(By.CLASS_NAME,'product-item')
    for element in elements:
        imageEle = element.find_element(By.CLASS_NAME,'product-item__primary-image').get_attribute('srcset')
        image = imageEle.split(',')[0].replace('//','https://').replace('200x','800x').split('?')[0]
        title = element.find_element(By.CLASS_NAME,'product-item__title').text
        price_section = element.find_element(By.CLASS_NAME,'product-item__price-list')
        product_url = element.find_element(By.CLASS_NAME,'product-item__image-wrapper').get_attribute('href')
        try:
            selling_price = price_section.find_element(By.CLASS_NAME,'price').text.replace("Sale price","").replace("Rs","").strip()
        except:
            selling_price = "None"
        
        availability = element.find_element(By.CLASS_NAME,'product-item__inventory').text

        itemDict = {
            "image":image,
            "title":title,
            "price":selling_price,
            "product_url":product_url,
            "availability":availability,
            "platform":"singhagiri",
            "category":category
        }
        offer_list.append(itemDict)
    return offer_list

# data = getSinghagiriData(r"https://www.singhagiri.lk/search?type=product&options%5Bprefix%5D=last&options%5Bunavailable_products%5D=last&q=refrigerator")
# print(data)
