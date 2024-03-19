# Web Scraping API for Sri Lankan Retailers

This Python Flask Web Scraping API is designed to scrape and provide data from some of Sri Lanka's leading retailers, including Abans, Singer, Damro, Singhagiri, and Softlogic. The API serves as a bridge for developers and analysts to access structured retail product data seamlessly.

## Features

- Scrape product data from multiple retailers: Abans, Singer, Damro, Singhagiri, and Softlogic.
- Access product information including price, specifications, and availability.
- Simple and intuitive endpoints for easy access to data.
- Server Dashboard for monitoring API usage and scraped data statistics.

## Installation

### Prerequisites

- Python 3.6 or higher
- Flask
- Requests
- BeautifulSoup4

### Steps

1. Clone the repository to your local machine.

```sh
git clone https://github.com/your-repository-link.git
cd your-repository-folder
```
2. Install the required Python packages.

```sh
pip install -r requirements.txt
```

3. create .env file and add MongoDB Connection String
```sh
MONGO_URL=<Connection String>
```

4. Start the Flask server.

```sh
flask run --host=0.0.0.0 --port=your-desired-port
```

5. Run in linux server as WSGI.

```sh
chmod +x deploy.sh
./deploy.sh
gunicorn -b 0.0.0.0:port -w 4 app:app --daemon # use desired port
```

### Usage
- After starting the Flask server, you can access the API at https://host:port/. Below are some example usages:


### Server Dashboard
- Access the server dashboard to view API usage and scraped data statistics.


```http
GET https://host:port/
```

### Retailer Product Data (API Mode)
- To retrieve product data from a specific retailer, use the following endpoints:

```http
GET https://host:port/abans?<search_result_url>
GET https://host:port/singer?<search_result_url>
GET https://host:port/damro?<search_result_url>
GET https://host:port/singhagiri?<search_result_url>
GET https://host:port/softlogic?<search_result_url>
```
- Replace https://host:port/ with your actual host and port where the API is running.

Note
- This API is intended for educational and research purposes. Please respect the retailers' websites' terms of use and avoid excessive requests that might impact their server performance.
The API's scraping capabilities depend on the structure of the retailer websites. If the retailers update their site layouts, the API might need adjustments.

### Scheduled Task Mode

Schedule data collection tasks to automatically run at specified intervals through a web interface. This interface allows for task management by adding, updating, deleting, and pausing tasks.

Instructions to Access and Manage Tasks:

- Navigate to https://host:port in your web browser to access the Web Scraping API's user interface.

- Sign in with your credentials to access the dashboard.

- Select the option to manage scheduled tasks.

- Here, you can add new tasks, modify existing ones, or manage the schedule and specifics of your data collection.