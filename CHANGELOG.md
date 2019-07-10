## Prequel 0.7.7-beta

> [Protoqol now has a dedicated Discord to allow for better communication](https://discord.gg/vZpwDVU)

### Functionality
- [FEATURE] Homepage now acts as a status page, keeping track of various things.
- [FEATURE] Separate browsing and managing modes       
    - Added tab switch in the top-left      
    - Added new default query parameter that contains the current mode
- [FEATURE] Prequel now uses it's own database instance with the config defined in `config/prequel.php`
- [FEATURE] Pagination feature by @aaronsaray (see #26)
- [FEATURE] Added extra error suggestions.
- [FEATURE] Config: DB key renamed to database; changed all child keys to lowercase.

### Fixed
- [FIX] Changed all config calls for database credentials. 
- [FIX] Style for PrequelError component now has a better layout + nice fa icon.
- [FIX] Searching in table function was sending params the wrong way around.
- [FIX] Added port to $dsn in DatabaseConnector.
- [FIX] Number of records in table not showing.
- [FIX] Fixed database connection credentials overlapping if too long. See #20.
- [REFACTOR] DatabaseController@findInTable optimised/simplified. 

### Readme
- [README] Added config docs to readme, fixing issue #28. 
- [README] Added better Twitter badge. 
- [README] Added Discord badge
