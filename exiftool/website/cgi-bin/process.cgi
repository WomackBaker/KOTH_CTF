#!/usr/bin/perl

use strict;
use warnings;
use CGI;
use File::Temp qw(tempfile);

print "Content-type: text/html\n\n";

my $cgi = CGI->new;
my $upload = $cgi->upload('image');

if (!$upload) {
    print "<html><body><h1>Error</h1><p>No file uploaded</p></body></html>";
    exit;
}

# Create temporary file
my ($fh, $filename) = tempfile(SUFFIX => '.jpg');
binmode($fh);
while (my $bytesread = read($upload, my $buffer, 1024)) {
    print $fh $buffer;
}
close($fh);

# Process with exiftool
my $output = `exiftool "$filename"`;

# Clean up
unlink($filename);

# Display results
print <<HTML;
<html>
<head>
    <title>Image Metadata Results</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        pre { background: #f5f5f5; padding: 10px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h1>Image Metadata Results</h1>
    <pre>$output</pre>
    <p><a href="/">Upload another image</a></p>
</body>
</html>
HTML 