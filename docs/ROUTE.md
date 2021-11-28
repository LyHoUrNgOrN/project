## ROUTE DOCUMENTATION EXAMPLE


### 1. Book Routes
---

| HTTP REQUEST| ROUTES | DESCRIPTION |
| :---        | :----   |          :--- |
| GET         | /books       |The route for get all books   |
| GET         | /books/{id}        |The route to get a book by given id |
| POST        | /books        |  The route to create a new book |
| PUT         | /books/{id}        | The route to update a book by given id |
| DELETE      | /books/{id}        | The route to delete a book|


### PUBLIC ROUTES 

    ## Sign Up/ Log In 

    | HTTP REQUEST | ROUTES        | DESCRIPTION |

    | POST         | /signup       |The route for user signup an account   |
    | POST         | /login        |The route for user login an account    |
### PRIVATE ROUTES

    ## Log Out

    | HTTP REQUEST | ROUTES        | DESCRIPTION |

    | POST         | /logout       |The route for user logout an account  |

    ## User Routes

    | HTTP REQUEST| ROUTES             | DESCRIPTION |

    | :---        | :----              |          :--- |

    | GET         | /users             | The route for get all users            |
    | GET         | /users/{id}        | The route to get a user by given id    |
    | POST        | /users             | The route to create a new user         |
    | PUT         | /users/{id}        | The route to update a user by given id |
    | DELETE      | /users/{id}        | The route to delete a user             |


     ## Category Routes

    | HTTP REQUEST| ROUTES             | DESCRIPTION |

    | :---        | :----              |          :--- |

    | GET         | /category             | The route for get all category             |
    | GET         | /category/{id}        | The route to get a category by given id    |
    | POST        | /category             | The route to create a new category         |
    | PUT         | /category/{id}        | The route to update a category by given id |
    | DELETE      | /category/{id}        | The route to delete a category             |

    ### Event Routes

    | HTTP REQUEST| ROUTES               | DESCRIPTION |

    | :---        | :----                |          :--- |

    | GET         | /category                                | The route for get all events by category    |
    | GET         | /category/subcategory                     | The route for get all events by subcategory |
    | GET         | /category/subcategory/{eventId }          | The route to get a event with subcategory by given id        |
    | GET         | /myevent/{searchcategory}                  | The route to get a event with subcategory by given search  |
    | POST        | /category/subcategory/                     | The route to create a new event with subcategory             |
    | PUT         | /category/subcategory/ {eventId }         | The route to update a event with subcategory by given id     |
    | DELETE      | /category/subcategory/ {eventId }         | The route to delete a event with subcategory by given id     |