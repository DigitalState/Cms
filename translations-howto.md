##UI Translations

Each SPA has it's own translation set that is fetched using a predefined slug in the corresponding `data` entity. A translation set is organized in a JSON hierarchy of objects for organizational purposes. For example, sidebar menu items get their titles from the following object in the translation set: 
```
"general": {
    "menu": {
    	"dashboard": "Dashboard",
    	"serviceDirectory": "Service Directory",
    	...
    }
}
```
So, in order to update the Dashboard menu title in French, we have to add the JSON object under the `fr` object as follows:
```
"fr": {
	"general": {
	    "menu": {
	    	"dashboard": "Tableau"
	    }
	}
}
```

Missing translations in the UI appear in a collapsed dot-notation format (e.g: `general.menu.dashboard`).

Since SPAs share some translations, a common set is used as a fallback. Translations that are not matched in any set are picked from the JSON translation files (en.json, fr.json, etc..) that ship with the SPA.

For example, in the Admin SPA translations are merged as follows:
`admin-translation` <- `common-translations` <- JSON files 

in the Portal SPA translations are merged as follows:
`portal-translation` <- `common-translations` <- JSON files 

##Formio Translations

Each Formio form has it's own `data` entity to hold it's translations. The slug used is formatted as follows: `formio-{{FORM_ID}}`. A the moment, Formio translations can be created/updated using Postman.

###Create form translation
POST the request body below to `http://45.79.141.45:8056/app_dev.php/datas`
```
{
	"owner": "BusinessUnit",
	"ownerUuid": "b20a40d9-b95b-4462-b8f1-c7453b9b7067",
	"identity": "Individual",
	"identityUuid": "9be0af28-ef41-49b7-86d9-72a2d9beb051",
	"slug": "formio-review-taxes",
	"title": { 
		"en": "Formio Translation (Pay taxes)",
		"fr": "Formio Traduction (Payer des taxes)" 
	},
	"data": {
        "en": {
            "First Name": "First Name",
            "Last Name": "Last Name",
            "Mobile Number": "Mobile Number",
            "To change your mobile number, you must edit your account profile": "To change your mobile number, you must edit your account profile"
        },
        "fr": {
            "First Name": "Prénom",
            "Last Name": "Nom de famille",
            "Mobile Number": "Numéro de portable",
            "To change your mobile number, you must edit your account profile": "Pour changer votre numéro de mobile, vous devez modifier le profil de votre compte"
        }
    },
	"version": 1
}
```

###Update form translation
PUT the request body below to `http://45.79.141.45:8056/app_dev.php/datas/{{DATA_ENTITY_UUID}}`
```
{
	"data": {
        "en": {
            "First Name": "XYZ"
        },
        "fr": {
            "First Name": "ABC"
        }
    },
	"version": 2
}
```