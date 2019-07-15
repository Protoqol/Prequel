## Prequel x.x.x-beta

> [Protoqol now has a dedicated Discord to allow for better communication](https://discord.gg/vZpwDVU)

### TODO before release
- Fix #19, non-alphabetic characters breaking Prequel. 
- Figure out support exact for Laravel 5.x
- Add support for postgres.
- Fix #37, not all column values are showing up

### Functionality
- [FEATURE] Testing framework setup by @aaronsaray (see #44)
- [FEATURE] You now see the table structure in an empty table (see #38)
- [FEATURE] Dark mode feature by @James-N-M (see #36).
- [FEATURE] Table scrollbar auto-hides when there is no overflow.
- [FEATURE] Commands to install and update Prequel.
- [FEATURE] Homepage now acts as a status page, keeping track of various things.
- [FEATURE] Separate browsing and managing modes. 
    - Added tab switch in the top-left to switch between Browse and Manage modes.
    - Added new default query parameter that contains the current mode.
    - Further functionality to be added.
- [FEATURE] Prequel now uses it's own database instance with the config defined in `config/prequel.php::database`
- [FEATURE] Pagination feature by @aaronsaray (see #26)
- [FEATURE] Added extra error suggestions.
- [FEATURE] Config: DB key renamed to database; changed all child keys to lowercase.

### Fixed
- [FIX] Scrollbar appearing on the bottom of table view.
- [FIX] With Prequel now using it's own config issues #23 #24 #29 are solved.
- [FIX] Changed all config calls for database credentials solving. 
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
