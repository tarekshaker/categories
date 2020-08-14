# Categories and Subcategories
 

## Installation & updates

After installation, run the following commands:

1.`composer install` 

2.`php spark migrate`

3.`php spark db:seed AddParentCategories`
 

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.


## Example
 

    ·   Category A 

    ·   Category B 

        ·   Select Category B, will create other select box with 

            ·   SUB B1 

            ·   SUB B2, Selecting Sub B2 will create select box 

                ·   SUB SUB B2-1 

                ·   SUB SUB B2-2 

And so on ...
