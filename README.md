

**##Plugin fields:**

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
<td>radio button - “price” or “range”</td>
</tr>
<tr>
<td>Price (USD)</td>
<td>_price</td>
<td>Text string</td>
</tr>
</tbody>
</table>

**General section**
    -  - “” (text)
    - Price Range - “_price_range” (dropdown)
      - Ultra High ($$$$) - “skimming”
      - Expensive ($$$) - “moderate”
      - Moderate ($$) - “economy”
      - Cheap ($) - “bellow_economy”
  - View Count - “_atbdp_post_views_count” (text)

**Contact Information**
  - Hide contact owner form for single listing page - “_hide_contact_info” (checkbox)
  - Zip/Post Code - “_zip” (text field)
  - Phone - “_phone” (text field)
  - Phone 2 - “_phone2” (text field)
  - Fax - “_fax” (text field)
  - Email - “_email” (text field)
  - Website - “_website” (text field)
  - Social Info - “_social” (nested array - platform ID and URL)
    - Platform - “id” (dropdown)
    - URL - “url” (text field)   

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
