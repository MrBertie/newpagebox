===== Syntax and Usage =====
Provides a "Add New Page" input box to your wiki page.  Simply type in the name of your new page and press enter to create it.  The box can be preset to a certain namespace, allowing you to quickly start a new page, for note taking for example.

To insert a box the syntax is as follows:

  {{newpagebox>ns;button;bymonth|byyear|by day;showns}}

===== Parameters =====
|ns=<namespace>  |Any valid dokuwiki namespace, including relative ones: . and ..  |''ns=dairy''  |
|button=<name>  |Name for the submit button, no spaces or symbols (a-zA-Z only)  |''button=Add''  |
|byday  |Adds a "year-month-day:" namespace  |''byday''  |
|bymonth  |Adds a "year-month:" namespace  |''bymonth''  |
|byyear  |Adds a "year:" namespace  |''bymonth''  |
|showns  |Show a small label above the box indicating the namespace to which the page will be added  |''showns''  |

For example:
  {{newpagebox>ns=drafts;button=Draft;bymonth}}

===== Purpose =====
