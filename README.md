ZeM STL
=============

#License

ZeM STL uses GNU GPLv3 or later.

# Features

ZeM STL is probably the best STL Viewer for WordPress which supports binary and ascii STL files without requiring any preprocessing, all the parsing is done on the client in javascript.It is based on Thingiview.js library, which is a performant and light library.

With ZeM STL you  are able to embedded STL files into a blog post. 2 modes are available: url and inline stl.
ZeM STL integrates shortcode syntax ([zemstl]) to use it directly into your posts.
Moreover, you can configure some parameters in ZeM STL like colors, size, ...

# Installation

Copy the folder zemstl into your WordPress plugin folder and activate it into WordPress Plugin Manager.

# Options

These options allow you to customize the stl rendering:

    * width: width of the render contener (default: 400)
    * height: height of the render contener (default: 350)
    * planes: show (1) or hide (0) the 100x100 grid plane under the object (default: 1).
    * rotation: object rotate slowly (1) or doesn't rotate (0) around the z axis (default: 1).
    * color: sets the object's color (default: #C0D8F0)
    * bgcolor: sets the background color of the viewer's container (default: #FFFFFF).
    * material: sets the object's material. Possible values are solid or wireframe (default: solid).
    * url: stl file url. Not mandatory if embedded stl is used.

# Options Commented

These options currently don't work. We will fixed it soon:

    * camera: sets the camera view to the desired angle. Possible values are top, side, bottom, diagonal (default: diagonal);
    * zoom: positive number to zoom the camera in or a negative number to zoom out (default: 4).

# Examples

<pre>
    Small: [zemstl url="http://pathtoyour.stl"/]

    Full: [zemstl width="400" height="300" planes="1" rotation="1" camera="diagonal" zoom="5" color="#C0D8F0" bgcolor="#FFFFFF" material="wireframe" url="http://path-to-your.stl"/]

    Inline: [zemstl url="http://pathtoyour.stl"]put-stl-code-here[/zemstl]
</pre>

# Contact Us

For new improvements or to notify bugs, you can contact us at http://www.zem.fr/