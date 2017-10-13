# Data Folder

Here is where you will put your json files.

# Json documentation

You will have some defined part according to the template you choose.

For this documentation, I will rely on the *'sidebar'* template; so the raw base of a file should look a bit like this :

```
{
    "sidebar": [],
    "main_panel": []
}
```

**Note:** If you want your page to have a header, you will have to put it right next to them.

You can then add items into your list !

## Items



## Lists
### Basic list

With this kind of list, you can actually combine some options :
- list: just a field of text
- icon: add an icon *(see below)* to the left of your item
- link: for html display, make your item clickable

#### list
```
{
    "type": "list",
    "title": "My list",
    "values": [
        { "title": "item 1", "desc": "desc 1" }
    ]
}
```