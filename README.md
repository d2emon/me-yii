me-yii
======

Rewriting Merchant Empires on Yii

# The Merchant Empires Server HOWTO

## Mitchell M. Harder, `dontpanicmmh@hotmail.com` v0.1, April, 2001

This HOWTO contains help and instructions for setting up and running a Merchant Empires Server.

<UL>
    <LI><A HREF="#ss3.1">3.1 Linux Installation</A>
    <UL>
        <LI><A HREF="#ss3.1.1">3.1.1 Red Hat</A>
        <LI><A HREF="#ss3.1.2">3.1.2 Mandrake</A>
        <LI><A HREF="#ss3.1.3">3.1.3 Others</A>
    </UL>
    <LI><A HREF="#ss3.2">3.2 Apache/Postgresql/Python</A>
    <LI><A HREF="#ss3.3">3.3 PHPLib</A>
    <LI><A HREF="#ss3.4">3.4 Merchant Empires</A>
    <LI><A HREF="#ss3.5">3.5 Python Imaging Library (PIL)</A>
    <LI><A HREF="#ss3.6">3.6 PHPPgAdmin</A>
    <LI><A HREF="#ss3.7">3.7 OpenME Scripts and Trading.php3</A>
</UL>
<UL>
    <LI><A HREF="#ss4.1">4.1 Creating, Initializing, and Destroying a Game Database</A>
    <LI><A HREF="#ss4.2">4.2 Map Creation</A>
    <LI><A HREF="#ss4.3">4.3 Game Creation</A>
    <LI><A HREF="#ss4.4">4.4 Creating the First Player</A>
    <LI><A HREF="#ss4.5">4.5 Map Locations</A>
</UL>

## 1. Introduction

Welcome to the **Merchant Empires Server HOWTO**, an attempt to outline the steps to install and run a Merchant Empires
Server.

Mitchell M. Harder *Maintainer--Merchant Empires Server HOWTO*

`dontpanicmmh@hotmail.com`

## 2. Background and *Caveat Emptor*

`-=* SECTION NOTES *=-`

When finished, this section will describe Bryan Brunton's development efforts for Merchant Empires, contain links to the
<A HREF=http://merchempires.sourceforge.net/>Merchant Empires SourceForge page</A>, and Bryan Brunton's game at
<A HREF=http://www.merchantempires.net/>www.merchantempires.net</A>.

Other references will probably include the OpenME efforts at
<A href=http://www.merchant-empires.com/>www.merchant-empires.com</A> and
<A href=http://www.me-players.com/>ME Players</A>.

### 2.1 *Caveat Emptor*

So, you want to know where to find the Merchant Empires RPM.  Well, I'm afraid we're currently not even close. OK, you
say, just give me the source so I can compile it. Well, again, I'm afraid installing merchant empires doesn't come close
to that level of simplicity.

At this time, installing a Merchant Empires Server involves installing several different packages, many of which need to
correctly interact with each other. It is going to involve manually manipulating databases with postgresql, learning how
to run and manipulate python scripts, learning and manipulating php scripts, and numerous other manual interventions.

So be prepared for a rather involved installation process.

## 3.Linux Installation and Suggested Software
### 3.1 Linux Installation
#### 3.1.1 Red Hat

The Red Hat distribution will support most of the Merchant Empires requirements 'out-of-the-box', without requiring the
building of several of the packages. Many of the remaining packages (such as PIL) are already somewhat Red Hat friendly.

`-=* SECTION NOTES *=-`

The postgresql in Red Hat 6.2 is out of date for Merchant Empires. The upgrade path involves several other packages. I
believe this means that the postgresql rev level needs to be 7+ (Red Hat 6.2 comes with 6.5.3). The Red Hat 7.1
'Wolverine' Beta was found to work for a large segment of the installation, but 'Wolverine' quirkiness has led to a
discontinuation of efforts on this front (even though is was very nearly finished).

Make sure the postgresql-python package is loaded.  It is not loaded by default

#### 3.1.2 Mandrake

`-=* SECTION NOTES *=-`

Bryan has cited Mandrake as providing a working distribution for Merchant Empires.

#### 3.1.3 Others

`-=* SECTION NOTES *=-`

I've had some success with Slackware, but building the packages was a complete pain.

<A HREF=http://www.weberdev.com/articles/ApachePHPandPostgreSQL.html> Apache, PHP, and PostgreSQL on RedHat Linux</A>

by Dave Jarvis

Even though the title indicates this article is for Red Hat, it describes how to build these packages from source, and
is pretty independent of Red Hat.

<A HREF=http://www.druid.net/pygresql/>PyGreSQL</A> is the package that will allow your python scripts to connect to
postgresql.

### 3.2 Apache/Postgresql/Python

These three packages must be built so that they all work together. For the purpose of this HOW-TO document, I am going
to assume that this integration is provided by the 'out-of-the-box' packages. This is the case for Red Hat and Mandrake.
Building these packages from the source with this integration will not be described in great detail in this document.

### 3.3 PHPLib

`-=* SECTION NOTES *=-`

The Merchant Empires package will contain a set of PHPLib files that are customized for ME. You will need to overwrite
the default PHPLib files with the files from the Merchant Empires package.

Steps 1-4 of the Installation instructions are most important.  The remainder seem to be geared towards mysql, which you
may or may not have installed.

When modifying the php.ini file, make sure your include_path modification considers phpPgAdmin (if installed) either by
including the current directory (ex: .:/home/apache/phplib/), or by expliciting pointing to the phpPgAdmin directory.

You must stop and start httpd after the modifications (a restart may not be sufficient).

### 3.4 Merchant Empires

`-=* SECTION NOTES *=-`

Currently, ME has several specific html references that will need to be modified. If you are implementing BryanME code,
you'll need to search and replace references to '127.0.0.1' with your server address. If you've downloaded the OpenME
code from www.merchant-empires.com, search for references to 'www.merchant-empires.com'.

Also, '/var/www' is hard-coded in some spots, which works OK on Red Hat (and probably Mandrake), but gave me trouble.

### 3.5 Python Imaging Library (PIL)

This package is needed by the image creation scripts for the sector maps. It can be found at
<A HREF=http://www.pythonware.com/products/pil/>http://www.pythonware.com/products/pil/</A>

`-=* SECTION NOTES *=-`

Compiling this package requires several graphics header files (.h). For Red Hat, these files are contained in these
packages: libpng-devel, libjpeg-devel, python-devel.

'make check' gives an xv error if compiled from console mode (X not running).

The final make may bomb out with the error: "/usr/bin/ld: cannot find -ltcl8.0", but as long as ?????.so compiled OK,
you can proceed.

### 3.6 PHPPgAdmin

PHPPgAdmin is a set of PHP tools that will allow you to manually manipulate the Merchant Empires database. Currently,
significant portions of game setup involve manual manipulations of the database, and a tool similar to this package is
nearly mandatory.

`-=* SECTION NOTES *=-`

The final text for this section will need to contain copious warnings regarding the dangers of having this package
installed if it is not properly secured.  Maybe, if we're lucky, some kind soul will provide some guidance on how to
secure the package.

<A HREF=http://www.greatbridge.org/project/phppgadmin/projdisplay.php>
http://www.greatbridge.org/project/phppgadmin/projdisplay.php</A>

The config.inc.php file may need to be edited for your user name and password for the database.

: Set line 52 to true
: 53 and 55 to the username you use ('postgres' is usually the default).
: 54 and 56 to the password you use (is stored as plain text, so make it different from your other passwords).

### 3.7 OpenME Scripts and Trading.php3

`-=* SECTION NOTES *=-`

b'garn python scripts

b'garn trading.php3

b'garn's pathfinder script is a python script that seems to perform the tasks of a compiled BryanME program of the same
name. B'garn's script is used to calculate the distance index so that longer trade routes are more profitable. I'm not
really sure if that's what the BryanME pathfinder does, because the BryanME pathfinder source is not included.

The b'garn pathfinder is designed to be run as either standalone program, or to be called from the event_processor when
ports are upgraded.

courceplot is the program that allows the 'plot course' function to be used. The courceplot included with BryanME does
not seem to work, and the source code is not included. b'garn's courceplot to will probably need some treaking to the
database connection settings to work correctly, and possible some changes in permissions.

## 4.Initializing a Game

`-=* SECTION NOTES *=-`

The preamble for this section might be the appropriate place to discuss the differences between `sector_id` and
`public_sector_id`, since it affects several sections. `public_sector_id` is the variable that players will see as the
identity of their current sector, but a `sector_id` is assigned to each `public_sector_id`. This number is assigned as a
sequence, and is unique for each sector. The game code will usually be looking for the `sector_id`, not the
`public_sector_id`, which is often confusing in the process of designing the game.

But the reason for this is so that you can have multiple maps (perhaps for different games) that start with the same
sector number, but the computer will still know them as a unique sector.

### 4.1 Creating, Initializing, and Destroying a Game Database

The `schema.out` file contains the instructions for initializing the Merchant Empires database. It is used to initialize
the database in the following manner.

```
# cd /path/to/ME/
# cd database
# su postgres
# createdb spacegame
# psql spacegame
> \i schema.out
```


The following commands can be used to completely erase the spacegame database. These commands are irreversable, so use
them with care, but you will probably need to reset the database from time to time as you learn how to get Merchant
Empires running.


From the Unix Command Prompt:

```
# su postgres
# dropdb spacegame
```

From a sql session:

```
> drop database spacegame
```

`-=* SECTION NOTES *=-`

A few database structures are not initialized that will need to be manually initialized. The implementation of a unique
id field for these database elements makes them slightly tricky to initialize. I'm sure there's a correct way to do it,
but I found I had to let postgres set the id field when inserting a record, then I had to edit the record to set the id
field to the required value.

The spelling must be exact for these names, since the code interlinks many of these items based on the exact spelling of
the name.

#### good_types Table
<table>
    <TR>
      <TH>good_type_id</TH><TH>name</TH>
    </TR>
    <TR>
      <TD>1</TD><TD>Biochemicals</TD>
    </TR>
    <TR>
      <TD>2</TD><TD>Food</TD>
    </TR>
    <TR>
      <TD>3</TD><TD>Ore</TD>
    </TR>
    <TR>
      <TD>4</TD><TD>Precious Metals</TD>
    </TR>
    <TR>
      <TD>5</TD><TD>Slaves</TD>
    </TR>
    <TR>
      <TD>6</TD><TD>Textiles</TD>
    </TR>
    <TR>
      <TD>7</TD><TD>Machinery</TD>
    </TR>
    <TR>
      <TD>8</TD><TD>Circuitry</TD>
    </TR>
    <TR>
      <TD>9</TD><TD>Weapons</TD>
    </TR>
    <TR>
      <TD>10</TD><TD>Computers</TD>
    </TR>
    <TR>
      <TD>11</TD><TD>Luxury Items</TD>
    </TR>
    <TR>
      <TD>12</TD><TD>Narcotics</TD>
    </TR>
</table>

#### technology_types Table
<table>
    <TR>
      <TH>technology_type_id</TH><TH>name</TH><TH>cost</TH>
      <TH>megawatts</TH><TH>expandable</TH><TH>additional_megawatts</TH>
    </TR>
    <TR>
      <TD>1</TD><TD>Shields</TD><TD>350</TD><TD>0</TD><TD>Yes</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>2</TD><TD>Armor</TD><TD>250</TD><TD>0</TD><TD>Yes</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>3</TD><TD>Cargo Holds</TD><TD>350</TD><TD>0</TD><TD>Yes</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>4</TD><TD>Illusion Generator</TD><TD>245000</TD><TD>10</TD><TD>No</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>5</TD><TD>Scanners</TD><TD>120000</TD><TD>5</TD><TD>No</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>6</TD><TD>Jump Drive</TD><TD>300000</TD><TD>10</TD><TD>No</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>7</TD><TD>Cloaking Device</TD><TD>500000</TD><TD>10</TD><TD>No</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>8</TD><TD>Mines</TD><TD>10000</TD><TD>0</TD><TD>Yes</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>9</TD><TD>Combat Drones</TD><TD>10000</TD><TD>0</TD><TD>Yes</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>10</TD><TD>Scout Drones</TD><TD>750</TD><TD>0</TD><TD>Yes</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>11</TD><TD>Tracking Device</TD><TD>200000</TD><TD>25</TD><TD>Yes</TD><TD>15</TD>
    </TR>
    <TR>
      <TD>12</TD><TD>Deep Space Scanner</TD><TD>250000</TD><TD>25</TD><TD>Yes</TD><TD>15</TD>
    </TR>
    <TR>
      <TD>13</TD><TD>Targeting Computer</TD><TD>300000</TD><TD>25</TD><TD>Yes</TD><TD>15</TD>
    </TR>
    <TR>
      <TD>14</TD><TD>Plasma Booster</TD><TD>350000</TD><TD>25</TD><TD>Yes</TD><TD>15</TD>
    </TR>
    <TR>
      <TD>15</TD><TD>** SKIP **</TD><TD>**</TD><TD>**</TD><TD>**</TD><TD>**</TD>
    </TR>
    <TR>
      <TD>16</TD><TD>Active Screens</TD><TD>325000</TD><TD>25</TD><TD>Yes</TD><TD>15</TD>
    </TR>
    <TR>
      <TD>17</TD><TD>Power Plant</TD><TD>700</TD><TD>0</TD><TD>Yes</TD><TD>0</TD>
    </TR>
    <TR>
      <TD>18</TD><TD>Tri-Focus Plasma</TD><TD>400000</TD><TD>25</TD><TD>Yes</TD><TD>15</TD>
    </TR>
</table>

#### treaty_types Table

|treaty_type_id|name         |
|--------------|-------------|
|1             |Free Movement|
|2             |War (???)    |

ship_types could use a modification to add a Unique index.

### 4.2 Map Creation

`-=* SECTION NOTES *=-`

creator.py

Suggest to modify python script to dump out the map number at the end. Also, phpPgAdmin can be used to examine the map
to get the map number.

b'garn scripts:  genports, genplanets, maze, and mazereal

maze seems to be an initial version of the maze generator, and doesn't make a very nice maze (to many isolated areas).
mazereal seems to be the program to use.

Two problems with genplanet. My postgresql/python didn't like the '\s' in some of the planet names. Also, genplanet
should be modified to initialize the good_types field to 1,2,3,4,5,6,7,8,9,10,11,12 (no spaces) to initialize the planet
stockpile.

images.py - There are some hard-coded directory locations at the end of the program. Also, I had to manually create the
directories for this to run, both 'images' and 'map##'.  It might work perfect if you call this script from the right
location, or perhaps set up the right symbolic links, but I'm not sure.

There should be a sub-section on the map-creation tools included with BryanME, and a strong warning to move the programs
to a secured directory once the game gets going.

### 4.3 Game Creation

`-=* SECTION NOTES *=-`

Game creation is made manually through phpPgAdmin.  Insert a new record into 'games'. Leave game_id alone, postgresql
wants to assign that value. The active_races field is looking for race numbers (separated by commas, without spaces?),
not race names.

All the sector id's entered in the game creation are the computer sector id, not the public sector id that everyone
see's dislpayed for the map sector.

It may be necessary to make an adjustment like this to the game database for the created game.

Note:  After I adjusted the sequence starting points in the database schema, this was un-necessary

```
spacegame=# CREATE SEQUENCE "public_player_id_game_5" start 4800 increment 1 maxvalue 2147483647 minvalue 1 cache 1;
CREATE
spacegame=# SELECT nextval ('"public_player_id_game_5"');
 nextval
---------
    4800
(1 row)

spacegame=# CREATE SEQUENCE "public_account_id_game_5" start 1750 increment 1 maxvalue 2147483647 minvalue 1 cache 1 ;
CREATE
spacegame=# SELECT nextval ('"public_account_id_game_5"');
 nextval
---------
    1750
(1 row)
```

In the above example, the game_id assigned by posgresql was '5'.

After creating your game, browse to find the `game_id` assigned to the game,
and browse `maps` to edit the map created in the previous section
to point to this `game_id`.

### 4.4 Creating the First Player

`-=* SECTION NOTES *=-`

When I first got ME running, I found myself manually intervening in the player creation process, but if things are set
up correctly (especially the note in section 4.3 on initializing the `public_player_id_game_#` and
`public_account_id_game_#`), no intervention should be required here.

### 4.5 Map Locations

`-=* SECTION NOTES *=-`

For most locations, it's a simple matter of entering the location manually using phpPgAdmin in `locations`, but some
require further discussion.

The Spelling is important. The spelling must be exactly the spelling the program is looking for. It's best to cut &
paste the spelling from `current_sector.php`.

```
Government Capital
Imperial Sectors
Imperial Starbase
Banks
Underground Centers
Technology Dealers
Ship Dealers
Weapons Dealers
Inter-Galaxy Warps
```

Tech Dealers, Ship Dealers, and Weapons Dealers use the options field to enter a numeric list (comma separated, no
spaces) to set the available merchandise. These numbers can be obtained from the tables in Section 4.1.


## 5. Running and Maintaining a Game

`-=* SECTION NOTES *=-`

I had trouble with the v0.86 event processor.  I've been running the v0.87
event processor even though the remainder of the code is v0.86.

No Problems so far ;)

web_root must be set in the defines so recreating the maps works on port upgrades

`vacuum_db spacegame` is very important for keeping access times down
as well as hard-disk usage.

I'm considering writing a script to add into the event processor to reset the
active_sessions database when no-one is in the active players list.
This database gets huge, and after a while, even vacuuming doesn't
seem to work on it really well.
