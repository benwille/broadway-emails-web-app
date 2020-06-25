# Broadway Emails Web App

This web app allows for the easy creation of Broadway Media station emails formatted for MailChimp.

## Getting Started

1. Create directory
2. Copy gulpfile.js, package.json, and this file (optional) into new directory
3. In command line run 'npm install'
4. Update gulpfile.js as needed
5. Run gulp commands with 'gulp <taskname>'

### Prerequisities

In order to run this web app you'll need:

* A server. Use MAMP/WAMP or Docker
  * [Windows](https://docs.docker.com/windows/started)
  * [OS X](https://docs.docker.com/mac/started/)
  * [Linux](https://docs.docker.com/linux/started/)
* PHP version 7.3 or higher

### Usage

This site is intended to help stations create weekly emails quickly and efficiently. Until automatic ingestion is set up the email is a two-step process.

1. Click on the arrow to the right of your station. And look for the dropdown tab that says "News Feed." Click "News Feed."
2. At the bottom of the page you will click "Add Articles."
3. Click your station link in the menu
4. Make sure all articles are in their correct catgory. If not, change the category and update the article.
5. Click the featured checkbox next to any article that should be featured at the very top of the email.
6. For each section you can position the articles in the order you would like. This is NOT required.
7. When you are statified with the positions of the email, click "Create Email" at the top of the page.
8. To get the code you can either **A)** File > Save the document. Then open it up in a text editor and copy the code to Mailchimp. **B)** Hit Command + U in Firefox or Option + Command + U in Chrome to open the source code. Then copy the code to Mailchimp.


### Gulp Tasks

You can find the list of tasks you can run in the gulpfile.js file. Here are the most common ones to help get you started.

##### Install packages
```bash
npm install
```

##### Update Source Files

```bash
gulp update-src
```

##### SASS processor, Minify, and Purge unused CSS

```bash
gulp styles
```

##### Lint and Fix PHP files

```bash
gulp phpcbf
```

#### Volumes

* `~/Sites/Broadway/emails` - File location

#### Useful File Locations

* `~/Sites/Broadway/emails/runEmailFeed.sh` - script to run news feed checks

* `~/Sites/Broadway/emails/emailfeed.log` - log for news feed script showing success and errors

## Built With

* Node v10.21.0
* npm v6.14.4
* PHP v7.3
* jQuery v3.3.1

## Find Me

* [GitHub](https://github.com/benwille)
* [Website](https://bwille.com/)

## Versioning

We use [SourceTree](https://www.sourcetreeapp.com/) for versioning.

### v2.1.1
- Removed unused files
- Changed Public folder to HTML
- Added .editorconfig and .eslintrc files for formatting

### v2.1.0
- Added AJAX functions for multiple changes with one update (June 23, 2020)

### v2.0.0
- Created dark version of emails (December 27, 2019)

### v1.3.0
- Added vCreative test sections. Not for public use (December 16, 2019)

### v1.2.0
- Added Clean, Dist, and Dev folders to prepare code for release (June 19, 2019)

### v1.1.0
- Added Gulpfile.js and gulp tasks - see **GULP TASKS** above (May 17, 2019)

### v1.0.0
- Initial version (December 31, 2018)


## Authors

* **Ben Wille** - *Initial work* - [Website](https://bwille.com/)

## License

This project is licensed under the MIT License.

## Acknowledgments

* Andrew Maxwell
* **Billie Thompson** - *README.md template* - [PurpleBooth](https://github.com/PurpleBooth)
