## Web Form To Collect A Mailing Address

### Version:-

**PHP** : 7.4
**Bootstrap** : 3.4.1
**Jquery** : 3.5.1
**Ajax Jquery** : 3.6.1
**jquery Validation** : 1.19.2

### Project File :-

Create a PHP File name (address_form.php) where we write our HTML and Jquery and Ajax code. and for CSS code we can make css file name (style.css) and for PHP code we can make PHP file name (insert.php).

### Project Database :-

Create A Database in PHPMyAdmin name (mailing_address) and then go to Sql option and create a table with 6 columns. 

**By this code:-**

CREATE TABLE address (
id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
address1 VARCHAR(255) NOT NULL,
address2 VARCHAR(255) NOT NULL,
city VARCHAR(255) NOT NULL,
state VARCHAR(255) NOT NULL,
zipcode VARCHAR(255) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
 
**OR**

give name of table (address) and select number of columns (6) and then click go and then add columns names , type(VARCHAR) and length (255) then click GO and table will create with a name of **address**.

### address validation API :-

1. We use Address Validation API for normalize/standardize the submitted form data from USPS.
2. we use **curl -v "https://us-street.api.smartystreets.com/street-address?key=21102174564513388&candidates=10&street=&city=&state=&zipcode=&match=enhanced&license=us-rooftop-geocoding-cloud"** for getting Standardize Address.
    * From USPS website :- **https://www.smarty.com/products/apis/us-street-api#demo**

### address validation API Key Error:-

1. When we use this API so we get error **Authentication required (1611079217)** 
2. We generate key and use on **curl -v "https://us-street.api.smartystreets.com/street-address?key=21102174564513388&candidates=10&street=&city=&state=&zipcode=&match=enhanced&license=us-rooftop-geocoding-cloud"** we got same error.
3. This is all because of Owner Verification for our Key which is important for use Address Validation API.