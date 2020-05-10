# rawmaterialsonline

Composer install
```
cd src
composer install
```

Docker setup:
```
cd docker
docker-compose up
```

# REST API

## 1) Resource: /segments
##### POST:	http://localhost:8000/segments
	data:   {
		"name": "First Segment"}
	}
	
##### GET: http://localhost:8000/segments/1

##### PUT: http://localhost:8000/segments/1
	data: {
		"name": "First Updated Segment"
	}

##### DELETE: http://localhost:8000/segments/1

##### GET: http://localhost:8000/segments


## 2) Resource: /families

##### POST:	http://localhost:8000/families
	data:   {
		"name": "First Family"}
	}

##### GET: http://localhost:8000/families/1

##### PUT: http://localhost:8000/families/1
	data: {
		"name": "First Updated Family"
	}

##### DELETE: http://localhost:8000/families/1

##### GET: http://localhost:8000/families

##3) Resource: /classes

#####POST:	http://localhost:8000/classes
	data:   {
		"name": "First Raw Class"}
	}
#####GET: http://localhost:8000/classes/1

#####PUT: http://localhost:8000/classes/1
	data: {
		"name": "First Updated Raw Class"
	}

#####DELETE: http://localhost:8000/classes/1
#####GET: http://localhost:8000/classes


##4) Resource: /commodities

#####POST:	http://localhost:8000/commodities
	data:   {
		"name": "First Commodity"}
	}

#####GET: http://localhost:8000/commodities/1

#####PUT: http://localhost:8000/commodities/1
	data:   {
    	"name": "Fourth Commodity",
    	"segment_id": "2",
    	"class_id": "2",
    	"family_id": "6"
    }
>Notes: Commodity required existing ids from Segment, Raw Class (Class) and Family tables.

#####DELETE: http://localhost:8000/commodities/1

#####GET: http://localhost:8000/commodities





