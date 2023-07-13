**##Plugin fields:**

**General section**
  - Tagline - “_tagline” (text field)
  - Pricing - “_atbd_listing_pricing” (radio button - “price” or “range”)
    - Price (USD) - “_price” (text)
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
  - Locations? - enable private taxonomies under “Taxonomies, Categories, Tags”
  - Categories? - enable private taxonomies under “Taxonomies, Categories, Tags”
  - Tags? - enable private taxonomies under “Taxonomies, Categories, Tags”
