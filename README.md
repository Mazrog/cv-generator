# CV - Generator

This is a little PHP-data-driven generator for documents like CV.

Some templates are already available, but you can add your own stylesheet and/or php templates directly into the *custom* folder.

The templates are filled with information found in a json file in the *data* folder.

---

## Left todo

- A bit of cleaning in the json fields for the *"block-list"* type
- Writing the JSON documentation
- Finishing the plain template

---
## Getting the PDF
To get the pdf document from the html page, just hit *CTRL+P*, or *Print*, and choose *Print to file*.
Be sure to check the options to print the background colors and images in the options pane.

---

## Predefined Templates

### Plain
The plainest design I could come out with.
[Coming soon](plouf "Glimpse coming soon")

### Sidebar
A simple layout, with a header, a sidebar and a mainpanel.
[Coming soon](plouf "Glimpse coming soon")

---

## Get started

*(29/09/17) EDIT:* The *plain* template is not finished yet, so this example uses the *sidebar* one.

### First steps 101

**index.php**
```
<?php
/* We need to include the file */
require_once 'framework/main.php';

/* We create a new document */
$d = new CV_Document();

/* Adding a new page, driven by the recto.json file, with a 'sidebar' layout */
$d->add_page('data/recto.json', 'sidebar');

/* That's all ! Let's render it ! */
$d->render();
?>
```

---

### A more complex example, with custom templates and stylesheets

With this folder structure :

```
custom
	templates
		myTemplate.php
	css
		myCss.css
data
	recto.json
	verso.json
framework
index.php
[...]
```

The code inside **index.php** :
```
<?php
/* We need to include the file */
require 'framework/main.php';

/* We create a new document */
$d = new CV_Document();

/* Adding two pages driven by two different files following two different layouts */
$d->add_page('data/recto.json', 'sidebar');
$d->add_page('data/verso.json', 'custom', 'myTemplate.php');

/* Adding our own stylesheet */
$d->add_custom_stylesheet('myCss.css');

/* That's all ! Let's render it ! */
$d->render();
?>
```

For conventions concerning the json keys, take a look at the full-example document in the Predefined Templates part.

---

## API

> **CV_Document** : Base object

This object represents the document, it will contains every page.



> **add_page**(data_file, layout, custom_template)
>
-	data-file : [**string**]
Absolute path for the json file
-	layout : [**string**, **optional**] **[default = 'plain']**
Name of a layout, picked among the existing ones (folder in the *'framework/layouts'*) 
-	custom_template : [**string**, **optional**] **[default = null]**
File name (or relative path from *'custom/templates'*) to be used as a template for this page

Use this method to add pages to your document.
If you specify a **customTemplate**, the **layout** argument becomes irrelevant, as it will be changed to suit your template.



> **add_custom_stylesheet**(stylesheet)
> 
-	stylesheet : [**string**] file name (or relative path from *'custom/css'*) of additional stylesheet to be included in the page

Use this method to add an other stylesheet for linking to your document.



>**render**()

The final method, used to render the whole document.


