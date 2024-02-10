# from selenium import webdriver
# from selenium.webdriver.common.keys import Keys
# from selenium.webdriver.common.by import By

# driver = webdriver.Chrome()
# driver.get("https://buyabans.com/refrigerators")


import json
from selenium import webdriver
from selenium.webdriver.common.by import By

from selenium.webdriver.chrome.options import Options

options = Options()
options.add_argument("--headless")
options.add_argument("--disable-gpu")  # Not always required, but recommended for some environments
options.add_argument("--window-size=1920,1080")
options.add_argument("user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36")
options.add_argument("accept-language=en-US,en;q=0.9")
options.add_argument("disable-blink-features=AutomationControlled")
options.headless = True


def getAbansData(url):

    def getTitle(param):
        try:
            return element.find_element(By.CLASS_NAME,param).text
        except:
            return "No Title"
    def getImage(param):
        try:
            return element.find_element(By.CLASS_NAME,param).get_attribute('src')
        except:
            return "No Image"
    def getOldPrice(parent,param):
        try:
            return parent.find_element(By.CLASS_NAME,param).text
        except:
            return "No Old Image"
    def getNewPrice(parent,param):
        try:
            return parent.find_element(By.CLASS_NAME,param).text
        except:
            return "No New Image"
        
    driver = webdriver.Chrome(options=options)
    driver.get(url)

    item_list = []

    elements = driver.find_elements(By.CLASS_NAME, 'product-item-info')

    for element in elements:
        item_dict = {}
        try:
            image = getImage('product-image-photo')
            title = getTitle('product-item-link')
            old_price_parent = element.find_element(By.CLASS_NAME,'old-price')
            new_price_parent = element.find_element(By.CLASS_NAME,'special-price')
            old_price = getOldPrice(old_price_parent,'price')
            new_price = getNewPrice(new_price_parent,'price')

        except:
            pass
        
        if(title):
            item_dict['title'] = title
            item_dict['image'] = image
            item_dict['old_price'] = old_price
            item_dict['new_price'] = new_price
            item_list.append(item_dict)

    driver.quit()
    return item_list



# data = GetAbansData("https://buyabans.com/refrigerators")
# json_string = json.dumps(data, indent=2)
# print(json_string)