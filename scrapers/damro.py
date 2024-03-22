import json
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options

chrome_options = Options()
chrome_options.add_argument('log-level=3')
chrome_options.add_experimental_option('excludeSwitches', ['enable-logging']) 
chrome_options.add_argument('--headless')
chrome_options.add_argument('--no-sandbox')
chrome_options.add_argument("user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36")
chrome_options.add_argument("accept-language=en-US,en;q=0.9")
chrome_options.add_argument("disable-blink-features=AutomationControlled")
chrome_options.headless = True

def getDamroData(url,category):

    def getBrand(url):
        find = ['innovex','samsung','damro','panasonic']  
        brand = url.split('/')[-1].lower()
        results = [item for item in find if item in brand]
        if results:
            return results[0]
        
    driver = webdriver.Chrome(options=chrome_options)
    driver.get(url)

    offer_list = []

    elements = driver.find_elements(By.CLASS_NAME,'product-wrapper')
    for element in elements:
            image = element.find_element(By.CLASS_NAME,'attachment-shop_catalog').get_attribute('src')
            title = element.find_element(By.CLASS_NAME,'product-name').text
            price_section = element.find_element(By.CLASS_NAME,'price')
            brand = getBrand(price_section.find_element(By.TAG_NAME,'img').get_attribute('src'))
            price = price_section.find_element(By.CLASS_NAME,'cash-price').text.replace("Rs.","").strip()
            link_element = element.find_element(By.CSS_SELECTOR, '.thumbnail-wrapper a')
            product_url = link_element.get_attribute('href')
            if product_url:
                url = product_url
            else:
                url = None
            try:
                title = f"{title}-{element.find_element(By.CLASS_NAME, 'ltr').text.strip()}".lower()
            except:
                pass
            try:
                title = f"{brand}-{title}".lower()
            except:
                pass
            
            itemDict = {
                "image":image,
                "title":title,
                "new_price":price,
                "product_url":url,
                "platform":"damro",
                "category":category
            }
            offer_list.append(itemDict)
    driver.quit()
    return offer_list