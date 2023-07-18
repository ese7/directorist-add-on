

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
<td>Radio Button - “price” or “range”</td>
</tr>
<tr>
<td>Price (USD)</td>
<td>_price</td>
<td>Text string</td>
</tr>
<tr>
<td>Price Range</td>
<td>_price_range</td>
<td>- Ultra High ($$$$) - “skimming”<br>
      - Expensive ($$$) - “moderate”<br>
      - Moderate ($$) - “economy”<br>
      - Cheap ($) - “bellow_economy”</td>
</tr>
<tr>
<td>View Count</td>
<td>_atbdp_post_views_count</td>
<td>Text string</td>
</tr>
</tbody>
</table>
      

**Contact Information**

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
<td>Hide contact owner form for single listing page</td>
<td>_hide_contact_owner</td>
<td>...</td>
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
<td>Nested array<br>
- Platform - “id” (dropdown)<br>
- URL - “url” (text field)
</td>
</tr>
</tbody>
</table>

 
 
  -  - “” (text field)
  - Social Info - “” (nested array - platform ID and URL)
       

**Map**
  - Address “_address” (text field)
  - Or Enter Coordinates (latitude and longitude) Manually (checkbox)
  - Latitude - “_manual_lat” (text field)
  - Longitude - “_manual_lng” (text field)
  - Hide Map (checkbox - yes/no)

**Images & Video**
  - Preview Image - “_listing_prv_img”  (single image - ID)
  - Slider Images - “_listing_img” (multiple images - serialized IDs (single))
  - Video - “_videourl” (text field)

**Sidebar**
  - Expiration Date and Time - “_expiry_date” (text)
  - Never Expires - “_never_expire” (checkbox - yes/no)
