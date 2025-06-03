#!/usr/bin/perl
use CGI;
use CGI::Carp qw(fatalsToBrowser);
use File::Copy;

print "Content-type: text/html\n\n";

my $cgi = new CGI;
print "<html><head><title>Image Upload</title></head><body>";
print "<h1>Image Upload</h1>";

if ($cgi->param('image')) {
    my $filename = $cgi->param('image');
    my $upload_dir = "/tmp/uploads/";
    mkdir $upload_dir unless -d $upload_dir;
    
    # Vulnerable ExifTool usage
    my $output = `exiftool "$filename"`;
    print "<pre>$output</pre>";
    
    # Move file to upload directory
    move($filename, $upload_dir . $cgi->param('image'));
    print "<p>File uploaded successfully!</p>";
} else {
    print <<HTML;
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="Upload">
    </form>
HTML
}

print "</body></html>"; 