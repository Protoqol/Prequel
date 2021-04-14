## Latest stable version: Prequel v1.22.4

### Prequel v1.22.4

##### Definitive for next release

- Import
- Export
- Log
- Settings
- Maintenance

### Refactored

- [REFACTOR] Code structure is now better organised

### Functionality

- [FEATURE] PostgresSQL support
- [FEATURE] i18n, Prequel is now multilingual!
- [FEATURE] Management-mode (5)
  - Insert row
  - Laravel specific actions (generating assets)
  - View structure
  - Write and run raw SQL within the Monaco Editor (same as the vscode editor)
  - Monaco editor for writing queries
- [FEATURE] Define your own suffix and namespace/directory when generating assets with the Laravel actions in config
- [FEATURE] Auto updater for Prequel

### Fixed

- [FIX] Assets
- [FIX] Custom path not working when multiple were selected
- [FIX] $visible model properties were not returning
- [FIX] Style fixes

---

### Prequel v1.13 - Out of beta

### Functionality

- [FEATURE] Defining your own middleware for Prequel in config
- [FEATURE] Partial PGSQL Support

###### Fixes and refactors were omitted

---

### Prequel v1.11.11-beta

##### Definitive for next release

- Add support for postgres.
- Fix #19, non-alphabetic characters breaking Prequel -- could not replicate.

### Refactored

- [BREAKING][refactor] Config: DB key renamed to database; changed all child keys to lowercase.
- [REFACTOR] DatabaseController@findInTable optimised/simplified.

### Functionality

- [FEATURE] Testing framework setup by @aaronsaray (see #44)
- [FEATURE] You now see the table structure in an empty table (see #38)
- [FEATURE] Dark mode by @James-N-M (see #36).
- [FEATURE] Table scrollbar auto-hides when there is no overflow.
- [FEATURE] Commands to install and update Prequel.
- [FEATURE] Homepage now acts as a status page, keeping track of various things.
- [FEATURE] Setting up separate browsing and managing modes.
  - Added tab switch in the top-left to switch between Browse and Manage modes.
  - Added new default query parameter that contains the current mode.
  - Further functionality to be added.
- [FEATURE] Prequel now uses it's own database instance with the config defined in `config/prequel.php::database`
- [FEATURE] Pagination feature by @aaronsaray (see #26)

### Fixed

- [FIX] #37, not all column values are showing up -> Caused by model's $hidden properties.
- [FIX] Added extra error suggestions.
- [FIX] Scrollbar appearing on the bottom of table view.
- [FIX] With Prequel now using it's own config issues #23 #24 #29 are solved.
- [FIX] Changed all config calls for database credentials.
- [FIX] Style for PrequelError component now has a better layout + nice fa icon.
- [FIX] Searching in table function was sending params the wrong way around.
- [FIX] Added port to $dsn in DatabaseConnector.
- [FIX] Number of records in table not showing.
- [FIX] Fixed database connection credentials overlapping if too long. See #20.

### Readme

- [README] Added config docs to readme, fixing issue #28.

---

Start of changelog
