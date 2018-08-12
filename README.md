# pushover-cli

Yet another [Pushover](https://www.pushover.net) CLI tool.

## Installation

Download the phar file:

```
wget https://github.com/peterjaap/pushover-cli/releases/download/0.1.0/pushover-cli.phar
```

Chmod it & move it:

```
chmod +x pushover-cli.phar
mv pushover-cli.phar /usr/local/bin/
```

Add alias to your `~/.bashrc` / `~/.zshrc` file (optional);

```
alias po=pushover-cli.phar send
```

## Configuration

1. Download the Pushover app in the [iOS App Store](https://itunes.apple.com/nl/app/pushover-notifications/id506088175?mt=8) or the [Google Play Store](https://play.google.com/store/apps/details?id=net.superblock.pushover&hl=nl)
1. Create an account from the app or at [Pushover.net](https://www.pushover.net).
1. Create an application in the [Pushover dashboard](https://pushover.net/apps/build) (name it 'CLI', for example).
1. Create a `.pushover.yaml` file in your home dir (`~/.pushover.yaml`) and fill it with your user and app token;

```
user: USER_TOKEN_HERE
app: APP_TOKEN_HERE
```

## How to use

```
$ pushover-cli.phar help send

Usage:
  send [options] [--] [<message>] [<title>]

Arguments:
  message                         The body of the message to be sent [default: ""]
  title                           The title of the message to be sent [default: ""]

Options:
  -l, --link[=LINK]               The link that accompanies the message
  -p, --priority[=PRIORITY]       The priority the message is to be sent with (0 is default, 1 is ignore quiet hours, 2 is repeat until acknowledged) [default: 0]
      --token[=TOKEN]             The app token to be used - find in Pushover dashboard
      --user[=USER]               The user token to be used - find in Pushover dashboard
  -h, --help                      Display this help message
  -q, --quiet                     Do not output any message
  -V, --version                   Display this application version
      --ansi                      Force ANSI output
      --no-ansi                   Disable ANSI output
  -n, --no-interaction            Do not ask any interactive question
  -lt, --link-title[=LINK-TITLE]  The title for the link that accompanies the message
  -v|vv|vvv, --verbose            Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Help:
  Send a message to Pushover


```

If no title is given, the name of the application will be used.