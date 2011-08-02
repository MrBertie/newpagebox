This add a "add new page box" on your page
Syntax : {{newpagebox>(ns);(button);bymonth|byyear}}
----
Parameters:
ns=<namespace> : any valid dokuwiki namespace, icluding . and ..
button=<name> : name for the add button, no spaces or symbols (a-zA-Z only)
bymonth : adds a "year-month:" namespace
byyear : adds a "year:" namespace
----
E.g. {{newpagebox>ns=drafts;button=Draft;bymonth}}