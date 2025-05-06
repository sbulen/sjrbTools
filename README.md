# sjrbTools
Some helpful tools for SMF'ers

This is a collection of utilities I use to perform maintenance on & testing of my SMF forum.  I am sharing them here in case others find them helpful.

Most of these utilities expose forum internals, and should be removed when not in use.

## SMF Inquiry Tools & Diagnostics

These tools are inquiry only & are used to perform diagnostics.

* ***smf_db_compare.php*** - This tool compares your database information to a vanilla SMF database, highlighting any changes. It works for all SMF1.x & 2.x & 3.x forums.
* ***smf_settings_diag.php*** - This tool dumps key settings.php entries and dumps the entire SMF settings table.  It works for SMF2.0 & 2.1 & 3.0.  ***NOTE -*** Some mods place sensitive information like passwords & hashes in the SMF settings table.  You may not want to share the output of this diagnostic publicly.
* ***smf_utf8_diag.php*** - This tool dumps a bunch of helpful information on the state of the character set & collation of your SMF database.  It works for SMF2.0 & 2.1 & 3.0.
* ***smf_hex_dump.php*** - This tool dumps occurances of a specific column in a specific record in hex.  Useful for debugging UTF8 data issues.  It is UTF8 safe - it will not chop a multi-byte character in half.  It works for SMF2.0 & 2.1 & 3.0. 
* ***smf_attachment_dirs.php*** - This tool dumps info about SMF attachment settings and directories, and will highlight several types of errors found: missing .dat extensions; invalid folder assignments; various attachmentUploadDir errors such as dir not found; files missing attachment records; attachment records missing files, etc.  It works for SMF2.1 & 3.0. 

## SMF Cron Jobs

* ***proxy_maint_cron.php*** - This is a very simple cron to prune back your image proxy cache every night.  SMF 2.0 & 2.1.  
* ***smf_read_inds_maint_2-0.php*** - This tool marks all boards read in a way that doesn't add millions of rows to your logs...  SMF 2.0 only; SMF 2.1 has this built in.

## SMF DB Update Utilities

**WARNING:** These tools update your forum database.  Use at your own risk.  ALWAYS back up your database before use.  ALWAYS run them in your test environment first to learn how they work & to confirm desired outcomes.

* ***smf_urls_paths.php*** - This tool converts all URLs and Paths throughout your SMF forum's database from one value to another.  SMF 2.0 & 2.1 & 3.0.  This tool updates all URLs and Paths found throughout the settings table, the themes table, the messages table, personal messages and members' signatures.  I use this to quickly clone working test environments, so they do not link to each other and I do not find myself working within the wrong environment after clicking on a link...  (Its original name was really_really_really_repair_settings.php, but I felt that was too long...)
* ***smf_innodb_converter.php*** - This tool converts your SMF forum's MySQL database engine to InnoDB.  SMF 2.0 & 2.1 & 3.0.  
* ***smf_quote_link_fixer.php*** - Checks & fixes all quote links.  May be used to correct any quote link with issues, such as a deleted originating message or an incorrect topic caused by splits/merges. It works for SMF2.0 & 2.1 & 3.0.
* ***smf_fix_log_actions.php*** - Checks & fixes all string lengths in log_actions. UTF8 conversions can break string lengths in serialized strings.  SMF2.0.
* ***smf_replace_old_bbc.php*** - Removes/replaces old BBC.  Provided a regex, substitutes the first captured group for the entire match.  Helpful when you no longer use old mods that added BBC to posts at some point.  SMF2.0 & 2.1 & 3.0.

## Github utility

* ***github_dump.php*** - Dumps Issue & PR info for a specified repository into a comma-delimited file. 

## mergeSMF

**WARNING:** These tools update your forum database.  Use at your own risk.  ALWAYS back up your database before use.  ALWAYS run them in your test environment first to learn how they work & to confirm desired outcomes.

* ***mergeSMF.php*** - Merges two forums.  SMF2.0 & 2.1.

For more information about the mergeSMF.php script, check the thread in the forum here:
https://www.simplemachines.org/community/index.php?topic=575102.0

## MySQL to Postgresql Utilities

**WARNING:** These tools update your forum database.  Use at your own risk.  ALWAYS back up your database before use.  ALWAYS run them in your test environment first to learn how they work & to confirm desired outcomes.

* ***pg_converter.php*** - Reads output from a mysqldump, then updates it to make it suitable for an import into postgresql.
* ***pg_convert_seqs.php*** - To be run after conversion from mysql to postgresql.  Updates sequences to ensure they are in sync with the current data.

For more information about these scripts, check the thread in the forum here:
https://www.simplemachines.org/community/index.php?topic=575453.0
