# Party Website

This is the source for the party submission page for SDV Amsterdance. Currently used for both `eindfeecie` and `galacie` (with appropriate branch names). Additionally, in the future this will be rewritten so as to be more generic and easily maintainable, because right now it is neither!

## Todo
Plan is to implement it in `django` with either a simple REST API (or using full django with the templates). Personally, I am for the complete seperation of website and backend, allowing us to run a completely separate instance of the backend and let people work independently on the front-end, not having to touch the backend unless specifically adding functionality.

- Rewrite backend
  - Emailing templates + personalisation
  - Different, preferably all in one, framework to make the code more concise
  - Possibilities 
    - Django
    - Django + DRF app
- Rewrite frontend
  - Make it easier to understand 
  - Easier to work with
  - Better validation / Form composition
  - Case for invalid data / failed form!
  - Possibilities
     - Angular 2


## Usage
Feel free to use anything here. For the frontend, there is nothing needed except for a browser for testing. When testing along with a backend, either CORS headers should be set (both server and client) for a remote server, or a local server should be started. This is easy on linux, and for Windows I would strongly recommend installing XAMPP server. 

After installing this stack, the `www/api/db.sql` should be loaded into the database, for the basic structure. (I know, bad habits and all). 

The next step is setting up the local config file. Copy `www/api/config.example.php` to `www/api/config.php` and fill in the values to correspond to your local server. Understand now why the backend needs to be rewritten? ;) 