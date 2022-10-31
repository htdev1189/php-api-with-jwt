# MarkDown

# h1
## h2
### h3
#### h4
##### h5
###### h6

Heading level 1
===============

Heading level 2
---------------

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, w

**bold text**

Lorem Ipsum is simply *ITALIC TEXT* of the printing and typesetting industry.

> Blockquotes with Multiple Paragraphs
>
> Blockquotes with Multiple Paragraphs


> ### The quarterly results look great!
> - list item
>
> *Italic* here
>
> **bold** here


- First item
- Second item
- Third item
    - Indented item
    - Indented item
- Fourth item

3. Close the file.


![Tux, the Linux mascot](https://uxwing.com/wp-content/themes/uxwing/download/hand-gestures/good-icon.png)



- Line
---
___
***

- Link
My favorite search engine is [name link](https://duckduckgo.com).

> 
> I love supporting the **[EFF](https://eff.org)**.
>
> This is the *[Markdown Guide](https://www.markdownguide.org)*.
>
> See the section on [`code`](#code).

At the command prompt, type


```
<html>
      <head>
      </head>
</html>
   ```





## here

- Download (**vender folder not add to repo when y push**)

```
composer require firebase/php-jwt
```

- function

```
    JWT::encode => create token
    JWT::decode => convert token to array (if expired => error)
```
-   Logic
```
    b1: Login để lấy token thông qua JWT (thiết lập giá trị tồn tại 1 ngày)
    b2: Lưu vô database
    b3: Khi gửi request lên thì cho thằng token này lên header thông qua lớp Bearer
    b4: Get header xuông, sau đó kiểm tra nó có trong database không
        TH1: có -> Kiểm tra hạn (Nếu hết hạn thì phải thực hiện login và ghi lại giá trị token)
        TH2: không -> thoát
```