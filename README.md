![Complianz Logo](https://really-simple-plugins.com/complianz-gdpr-plugin-released/complianz-logo-concept-300x75-huh/)

# About Complianz Integrations

These .php files can be used by Complianz users to extend functionalities, either within Complianz itself, other services or plugins. Some integrations built upon premium features, and others can be used by all users. An example of a integration for premium users is creating variability in GEOIP, so you can choose regions or countries by code to serve existing consent management. 

We are open to new pull requests and integration requests if you found a new way to use Complianz for your specific needs.

## For Plugin Developers

We will include plugin specific integrations as well. We will keep adding new integrations on our own account, but recommend other plugin developers to do the same. For documentation, please [read this article](https://complianz.io/developers-guide-for-third-party-integrations/)

Some integrations will be integrated directly in Complianz.

## How to use these integrations

If you're using Complianz and want to extend the functionality with an integration, please follow these steps:

1. Choose the integration you woold like to use and copy/paste this to a simple text editor, for example TextEdit on Mac and Notepad on Windows.
2. Double check if your pasted code starts with: <?php (on the first line).
3. Some integrations must be edited to serve your purpose, for example when your want to change country codes or URL's.
4. Save as filename.php - we recommend choosing a filename which is recognizable of its purpose.
5. Open FTP - and go to wp-content/mu-plugins/ drop you file here. If the folder mu-plugins does not exist, simple add a new folder.
6. Check your site if the plugin has the desired functionality. For some filters it might be neccesary to clear your cache and test in a private/incognito browser window when testing. If any errors appear, you can simply delete the file from the mu-plugins folder.

We at Complianz are always happy to assist, so leave a ticket at [complianz.io](https://complianz.io/support/) if you need any help.
