![Laravel Prequel](./assets/prequel.png)

# Laravel Prequel #
#### Clear and concise database management ####

<img src="./assets/prequel_screenshot.png" width="700">

Look <a href="https://protoqol.github.io/Prequel/" target="_blank">here</a> for more!

### Workflow


**Done**
- [x] [FIX] "This table is empty" message not showing up.
- [x] [FIX] Reset searchInTable inputs after table change.
- [x] [FIX] Hardcoded asset paths.
- [x] [FEATURE] Better logo.
- [x] [FEATURE] Routing, you can now go to ?database=my_database&table=my_table to select my_table.
- [x] [FEATURE] Keep track of currently selected table in accordion menu. With active color.
- [x] [FEATURE] Search for table in menu search bar.
- [x] [FEATURE] When clicked on table column, auto-select that column to be searched in.
- [x] [REFACTOR] Better searching in tables.

**Doing - <small>priority from highest to lowest</small>**
- [ ] [FEATURE] Storing preferences about front-end in localStorage.
- [ ] [REFACTOR] Refactor inline css classes to sass @apply tags.

**Next**
- [ ] [FIX] Set up testing.
- [ ] [FIX] Close all other databases in menu when table in another is selected.

**Scheduled - <small>sorted by type</small>**
- [ ] [FIX] Clearer horizontal table scrolling (scrollbar at top or something similair) Hint: (scrollTo column element)
- [ ] [FIX] Add polyfills for history and url API.
- [ ] [FIX] URL and history should work better together, you can't go back and get the previous selected table now.
- [ ] [FIX] Better SRP enforcement, not because it matters, but because the code is getting messy.
- [ ] [FIX] More descriptive 'This query did not yield any result' message.
- [ ] [FIX] Resolve @TODO's.
- [ ] [FEATURE] Type check searchInTable value to allow for better search results.
- [ ] [FEATURE] SELECT (fields) query and only show those columns.
- [ ] [FEATURE] Show a pseudo SQL query when searchingInTable.
- [ ] [FEATURE] On cell right click to edit, save it.
- [ ] [FEATURE] Dark mode.
- [ ] [FEATURE] Hide table/database from view.
- [ ] [FEATURE] Multiple tabs for multiple tables.
- [ ] [FEATURE] Suggestions for better performance/database health with graph.
- [ ] [FEATURE] Pagination of data.
- [ ] [FEATURE] Support multiple database connections. 
- [ ] [FEATURE] Responsiveness. 
- [ ] [REFACTOR] Try to remove/combine some attributes as the HTML is becoming unreadable.
- [ ] [REFACTOR] Better code readability.

**Suggested**
- [ ] [SUGGESTION] VUEX 
- [ ] [SUGGESTION] ...
