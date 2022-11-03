Description

    Crawl Wikipedia for ISO-4217.

Endpoint

    POST https://6ihqfpspayyixqxyv6g77eqdty0rkdlk.lambda-url.us-east-1.on.aws/crawl/iso-4217

Body Ex.1:

    {
        "code_list" : [
            "GBP",
            "GEL",
            "HKD"
        ]
    }

Body Ex.2

    {
        "number_list" : [
            242,
            324
        ]
    }

Stack

    composer@2.2.6
    php@8.1.2
    vapor