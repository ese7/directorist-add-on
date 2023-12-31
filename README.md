**##Plugin fields:**

**General section**
<table>
<thead>
<tr>
<th>Name</th>
<th>Custom Field</th>
<th>Values</th>
</tr>
</thead>
<tbody>
<tr>
<td>Tagline</td>
<td>_tagline</td>
<td>Text string</td>
</tr>
<tr>
<td>Pricing</td>
<td>_atbd_listing_pricing</td>
<td>"price" for Price, "range" for Range</td>
</tr>
<tr>
<td>Price (USD)</td>
<td>_price</td>
<td>Text string</td>
</tr>
<tr>
<td>Price Range</td>
<td>_price_range</td>
<td>
      - skimming (Ultra High ($$$$))<br>
      - moderate (Expensive ($$$))<br>
      - economy (Moderate ($$))<br>
      - bellow_economy (Cheap ($))</td>
</tr>
<tr>
<td>View Count</td>
<td>_atbdp_post_views_count</td>
<td>Text string</td>
</tr>
<tr>
<td>Hide contact owner form for single listing page</td>
<td>_hide_contact_owner</td>
<td>Blank for no, "on" for yes</td>
</tr>
<tr>
<td>Zip/Post Code</td>
<td>_zip</td>
<td>Text string</td>
</tr>
<tr>
<td>Phone</td>
<td>_phone</td>
<td>Text string</td>
</tr>
<tr>
<td>Phone 2</td>
<td>_phone2</td>
<td>Text string</td>
</tr>
<tr>
<td>View Count</td>
<td>_atbdp_post_views_count</td>
<td>Text string</td>
</tr>
<tr>
<td>Fax</td>
<td>_fax</td>
<td>Text string</td>
</tr>
<tr>
<td>Email</td>
<td>_email</td>
<td>Text string</td>
</tr>
<tr>
<td>Website</td>
<td>_website</td>
<td>Text string</td>
</tr>
<tr>
<td>Social Info</td>
<td>_social</td>
<td><i>Nested array</i><br>
- id (Platform)<br>
- url (URL)
</td>
</tr>
<tr>
<td>Address</td>
<td>_address</td>
<td>Text string</td>
</tr>
<tr>
<td>Latitude</td>
<td>_manual_lat</td>
<td>Text string</td>
</tr>
<tr>
<td>Longitude</td>
<td>_manual_lng</td>
<td>Text string</td>
</tr>
<tr>
<td>Hide Map</td>
<td>_hide_map</td>
<td>Blank for no, "1" for yes
</td>
</tr>
<tr>
<td>Preview Image</td>
<td>_listing_prv_img</td>
<td>Image URL</td>
</tr>
<tr>
<td>Slider Images</td>
<td>_listing_img</td>
<td>Delimited Image URLs</td>
</tr>
<tr>
<td>Video</td>
<td>_videourl</td>
<td>Text string</td>
</tr>
<tr>
<td>Expiration Date and Time</td>
<td>_expiry_date</td>
<td>Text string</td>
</tr>
<tr>
<td>Never Expires</td>
<td>_never_expire</td>
<td>Blank for no, "1" for yes</td>
</tr>
</tbody>
</table>

<br>

**##Known issue**
Imported listings aren't visible on the frontend. To fix it, do the following:
1. Enable "Show private taxonomies" in the "Taxonomies, Categories, Tags" section.
2. Select "Listing Type" and type in "General" under "Each Directory listing has just one Listing Type".
   
See: https://github.com/sovware/directorist/issues/1337
