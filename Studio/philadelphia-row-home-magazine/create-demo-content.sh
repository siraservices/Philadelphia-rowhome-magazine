#!/bin/bash
# RowHome Magazine - Demo Content Generator
# Creates sample posts, categories, pictorials for template demos

PHP_PATH="C:/Users/julio/AppData/Roaming/Local/lightning-services/php-8.2.27+1/bin/win64/php.exe"
EXT_DIR="C:/Users/julio/AppData/Roaming/Local/lightning-services/php-8.2.27+1/bin/win64/ext"
WP_CLI="C:/Users/julio/wp-cli.phar"
WP_PATH="C:/Users/julio/Studio/philadelphia-row-home-magazine"

wp() {
    "$PHP_PATH" -d "extension_dir=$EXT_DIR" -d "extension=pdo_sqlite" -d "extension=sqlite3" "$WP_CLI" "$@" --path="$WP_PATH"
}

echo "=== RowHome Magazine Demo Content Generator ==="
echo ""

# -----------------------------------------------
# 1. Create Department Categories
# -----------------------------------------------
echo "--- Creating Department Categories ---"

DEPARTMENTS=("Life" "Business" "Arts" "Lifestyle" "Health" "Real Estate" "Menu" "Music & Art" "Brides Guide" "Writers Block" "Sports" "Environment" "Fashion" "Travel" "People" "Flashback" "Tech" "Education" "Politics" "Film" "History" "Community" "2025 Hotspots" "Events" "Games")

for dept in "${DEPARTMENTS[@]}"; do
    slug=$(echo "$dept" | tr '[:upper:]' '[:lower:]' | sed 's/ & /-/g' | sed 's/ /-/g' | sed "s/'//g")
    existing=$(wp term list department_category --slug="$slug" --format=count 2>/dev/null)
    if [ "$existing" = "0" ] || [ -z "$existing" ]; then
        wp term create department_category "$dept" --slug="$slug" 2>/dev/null
        echo "  Created: $dept ($slug)"
    else
        echo "  Exists: $dept ($slug)"
    fi
done

echo ""

# -----------------------------------------------
# 2. Create Gallery Categories
# -----------------------------------------------
echo "--- Creating Gallery Categories ---"

GALLERY_CATS=("Street Photography" "Architecture" "Food & Drink" "Events" "Portraits" "Neighborhoods")

for gcat in "${GALLERY_CATS[@]}"; do
    slug=$(echo "$gcat" | tr '[:upper:]' '[:lower:]' | sed 's/ & /-/g' | sed 's/ /-/g')
    existing=$(wp term list gallery_category --slug="$slug" --format=count 2>/dev/null)
    if [ "$existing" = "0" ] || [ -z "$existing" ]; then
        wp term create gallery_category "$gcat" --slug="$slug" 2>/dev/null
        echo "  Created: $gcat"
    else
        echo "  Exists: $gcat"
    fi
done

echo ""

# -----------------------------------------------
# 3. Create Feature Articles (long-form posts)
# -----------------------------------------------
echo "--- Creating Feature Articles ---"

# Article 1 - Life
wp post create --post_type=post --post_status=publish \
    --post_title="The Hidden Soul of South Philadelphia: How One Block Tells the Story of a City" \
    --post_excerpt="From the cobblestone streets to the corner delis, South Philly's 9th Street corridor remains the beating heart of Philadelphia's immigrant story — and its future." \
    --post_content="$(cat <<'CONTENT'
<p>On a Tuesday morning in early spring, before the Italian Market stalls unfurl their awnings, Maria Russo is already at work. Her family has been selling produce on 9th Street for four generations, and the rhythm of her mornings hasn't changed much since her grandmother's time.</p>

<p>"People think the Market is just about cheesesteaks and cannoli," she says, arranging a pyramid of blood oranges with practiced hands. "But this street — this street is where Philadelphia figures out who it is, over and over again."</p>

<blockquote><p>"This street is where Philadelphia figures out who it is, over and over again."</p><cite>— Maria Russo, fourth-generation vendor</cite></blockquote>

<h2>A Street That Tells Stories</h2>

<p>The 9th Street Italian Market, stretching from Wharton to Fitzwater, is often cited as the oldest continuously operating open-air market in America. But reducing it to a historical landmark misses the point. This is a living, breathing organism that has absorbed waves of immigration — Italian, Mexican, Vietnamese, Korean — and woven them into something unmistakably Philadelphian.</p>

<p>Walking north from Washington Avenue on any given Saturday, you'll pass a Vietnamese pho shop next to a century-old Italian butcher, a Mexican taqueria beside a cheese shop that's been aging provolone since 1906. The air is thick with competing aromas: roasting pork, fresh cilantro, espresso, fish on ice.</p>

<h2>The New Generation</h2>

<p>But change is coming, as it always does. Young entrepreneurs are opening trendy coffee shops and farm-to-table restaurants alongside the old-guard vendors. Some longtime residents worry about gentrification; others see it as the latest chapter in the market's perpetual reinvention.</p>

<p>David Nguyen, whose parents opened their bánh mì shop in 1985, takes the long view. "My parents were the newcomers once. People were skeptical. Now we're part of the fabric. That's how this street works — it absorbs you."</p>

<p>Standing at the intersection of 9th and Christian, where you can see four different flags hanging from apartment windows above the storefronts, it's hard to argue with him. This is Philadelphia in miniature: gritty, generous, perpetually in motion, and deeply, stubbornly itself.</p>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

LIFE_POST_ID=$(wp post list --post_type=post --post_title="The Hidden Soul of South Philadelphia" --format=ids 2>/dev/null)
if [ -n "$LIFE_POST_ID" ]; then
    wp post term set "$LIFE_POST_ID" department_category life 2>/dev/null
    wp post meta update "$LIFE_POST_ID" _post_layout "" 2>/dev/null
    echo "  Created: Feature Article - Life (ID: $LIFE_POST_ID)"
fi

# Article 2 - Business
wp post create --post_type=post --post_status=publish \
    --post_title="Philadelphia's Tech Renaissance: Why Startups Are Choosing Philly Over Silicon Valley" \
    --post_excerpt="With lower costs, world-class universities, and a thriving culture, Philadelphia is becoming the unexpected darling of the tech startup world." \
    --post_content="$(cat <<'CONTENT'
<p>Five years ago, when Sarah Chen told her Stanford classmates she was moving her AI startup to Philadelphia, they thought she was joking. Today, her company employs 200 people in a converted warehouse in Fishtown, and she's not the only founder who's made the leap.</p>

<p>"Everyone asks me why Philly," Chen says from her office overlooking the Delaware River. "I ask them: why not? We have Penn, Drexel, Temple pumping out talent. The cost of living means my team can actually afford to live well. And the food scene doesn't hurt."</p>

<blockquote><p>"We have everything Silicon Valley has, except the ego and the three-thousand-dollar studio apartments."</p><cite>— Sarah Chen, CEO of NeuralPath AI</cite></blockquote>

<h2>The Numbers Don't Lie</h2>

<p>According to a recent report by the Philadelphia Commerce Department, tech employment in the city has grown 34% since 2020. Venture capital flowing into Philadelphia-based startups exceeded $4.2 billion last year — a record — with particular strength in biotech, fintech, and artificial intelligence.</p>

<p>The University City Science Center, Pennovation Works, and the growing cluster of incubators in North Philadelphia have created an ecosystem that rivals Austin and Denver for startup density, at a fraction of the cost.</p>

<h2>The Culture Factor</h2>

<p>But it's not just economics driving the migration. Philadelphia offers something harder to quantify: character. The city's no-nonsense attitude, its walkable neighborhoods, its arts scene, and yes, its legendary food culture create a quality of life that attracts and retains talent in ways that ping-pong tables and free kombucha simply can't match.</p>

<p>"My engineers can buy houses here," says Marcus Williams, founder of FinStack, a fintech startup in Center City. "They can walk to work. They have actual lives outside the office. That makes them better at their jobs."</p>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

BIZ_POST_ID=$(wp post list --post_type=post --post_title="Philadelphia's Tech Renaissance" --format=ids 2>/dev/null)
if [ -n "$BIZ_POST_ID" ]; then
    wp post term set "$BIZ_POST_ID" department_category business 2>/dev/null
    echo "  Created: Feature Article - Business (ID: $BIZ_POST_ID)"
fi

# Article 3 - Health
wp post create --post_type=post --post_status=publish \
    --post_title="The Running Revolution: How Philadelphia Became America's Most Walkable Wellness City" \
    --post_excerpt="From the Schuylkill River Trail to community yoga in Rittenhouse Square, Philly is redefining urban fitness." \
    --post_content="$(cat <<'CONTENT'
<p>It's 6 AM on a Saturday, and the Schuylkill River Trail is already alive. Runners, cyclists, and power-walkers stream along the waterfront path in a current of spandex and determination. A decade ago, this scene would have been unimaginable. Today, it's just another morning in Philadelphia.</p>

<p>The transformation of Philadelphia into a wellness destination didn't happen by accident. A combination of infrastructure investment, community organizing, and cultural shift has turned one of America's most historically unhealthy cities into a model for urban fitness.</p>

<h2>Trail Miles and Changed Lives</h2>

<p>The numbers are striking. Since 2018, the city has added 47 miles of protected bike lanes and multi-use trails. The Schuylkill River Trail, once a neglected industrial corridor, now stretches 75 miles and attracts over 2 million users annually. The Circuit Trails network, when complete, will connect 800 miles of pathways across the greater Philadelphia region.</p>

<blockquote><p>"We didn't just build trails. We built a community. When you see your neighbor running every morning, eventually you lace up too."</p><cite>— Dr. Patricia Ogunleye, Philadelphia Department of Public Health</cite></blockquote>

<h2>Community-Driven Wellness</h2>

<p>But the real story isn't infrastructure — it's people. Free community fitness classes have exploded across the city. Yoga in Rittenhouse Square draws hundreds every Sunday. Running clubs in every neighborhood have become social hubs as much as fitness groups.</p>

<p>The Fishtown Runners Club, which started with six friends in 2019, now has over 1,500 members. "It's the most diverse group I've ever been part of," says co-founder James Park. "Doctors running next to construction workers, teenagers next to retirees. The trail doesn't care about your zip code."</p>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

HEALTH_POST_ID=$(wp post list --post_type=post --post_title="The Running Revolution" --format=ids 2>/dev/null)
if [ -n "$HEALTH_POST_ID" ]; then
    wp post term set "$HEALTH_POST_ID" department_category health 2>/dev/null
    echo "  Created: Feature Article - Health (ID: $HEALTH_POST_ID)"
fi

# Article 4 - Real Estate
wp post create --post_type=post --post_status=publish \
    --post_title="Row Home Renaissance: The Neighborhoods Where History Meets Modern Living" \
    --post_excerpt="Philadelphia's iconic row homes are experiencing a revival as young buyers discover the charm of historic architecture with contemporary renovations." \
    --post_content="$(cat <<'CONTENT'
<p>There's a particular Philadelphia sound that no other city can replicate: the echo of footsteps on a narrow marble staircase inside a century-old row home. It's a sound that connects you to generations of families who climbed those same stairs — and it's a sound that a new generation of homeowners is falling in love with.</p>

<p>Philadelphia's row homes, those distinctive brick-fronted residences that line block after block of the city's residential neighborhoods, are experiencing what real estate agents are calling a renaissance. After decades of decline in some areas, these homes are being reimagined for 21st-century living.</p>

<h2>The Numbers</h2>

<p>In neighborhoods like Fishtown, Graduate Hospital, and Brewerytown, renovated row homes are selling for $450,000 to $800,000 — numbers that would have seemed absurd a decade ago. But compared to equivalent brownstones in Brooklyn ($2M+) or row houses in Georgetown ($1.5M+), Philadelphia remains a relative bargain.</p>

<blockquote><p>"Where else can you buy a three-story brick home with original hardwood floors and a rooftop deck for under half a million? Philadelphia is the best-kept secret in East Coast real estate."</p><cite>— Jennifer Walsh, Keller Williams Realty</cite></blockquote>

<h2>Preserving Character</h2>

<p>The best renovations honor the bones of these homes while opening them up for modern living. Exposed brick walls, restored tin ceilings, and original mantels pair with open kitchens, smart home technology, and energy-efficient windows. The result is something uniquely Philadelphia: historical authenticity married to contemporary comfort.</p>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

RE_POST_ID=$(wp post list --post_type=post --post_title="Row Home Renaissance" --format=ids 2>/dev/null)
if [ -n "$RE_POST_ID" ]; then
    wp post term set "$RE_POST_ID" department_category real-estate 2>/dev/null
    echo "  Created: Feature Article - Real Estate (ID: $RE_POST_ID)"
fi

# Article 5 - Menu
wp post create --post_type=post --post_status=publish \
    --post_title="Beyond the Cheesesteak: 12 Restaurants Redefining Philadelphia Dining in 2026" \
    --post_excerpt="From a converted firehouse in Kensington to a rooftop garden in West Philly, these restaurants are putting Philadelphia on the global culinary map." \
    --post_content="$(cat <<'CONTENT'
<p>Let's get one thing straight: Philadelphia will always be a cheesesteak city. But if that's all you think we have to offer, you haven't been paying attention. The dining scene here has undergone a quiet revolution, and the rest of the country is finally catching on.</p>

<p>James Beard nominations for Philadelphia restaurants have tripled in the past five years. Three new Michelin stars were awarded in the city last year. And perhaps most importantly, the diversity of cuisines available — from Ethiopian to Filipino, Oaxacan to Szechuan — rivals any food city in America.</p>

<h2>The List</h2>

<p>Here are twelve restaurants that represent the best of Philadelphia's new dining landscape. They range from fine dining to casual counter service, from established institutions to scrappy newcomers. What they share is a commitment to craft, a connection to community, and a distinctly Philadelphian refusal to follow trends.</p>

<blockquote><p>"Philadelphia chefs don't cook to impress New York food critics. They cook to feed their neighbors. That authenticity is what makes this city's food scene so exciting."</p><cite>— Craig LaBan, Philadelphia Inquirer food critic</cite></blockquote>

<p>From the wood-fired pizzas at Fiamma in Passyunk to the tasting menu at Elara in Rittenhouse, from the legendary brunch at Honey's in Northern Liberties to the innovative Vietnamese cuisine at Má in Chinatown, this is a city that takes its food seriously — but never too seriously.</p>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

MENU_POST_ID=$(wp post list --post_type=post --post_title="Beyond the Cheesesteak" --format=ids 2>/dev/null)
if [ -n "$MENU_POST_ID" ]; then
    wp post term set "$MENU_POST_ID" department_category menu 2>/dev/null
    echo "  Created: Feature Article - Menu (ID: $MENU_POST_ID)"
fi

# Article 6 - Music & Art
wp post create --post_type=post --post_status=publish \
    --post_title="The Mural Capital: How Philadelphia's Street Art Scene Conquered the Art World" \
    --post_excerpt="With over 4,000 murals and a growing gallery district, Philadelphia's art scene is no longer the underdog." \
    --post_content="$(cat <<'CONTENT'
<p>Philadelphia has more public murals than any city in the world. That fact alone would be worth celebrating. But what makes the city's art scene truly remarkable isn't just the quantity — it's how deeply woven into the fabric of daily life these works have become.</p>

<p>Walk through any neighborhood and you'll encounter art that isn't sequestered behind museum walls or gallery doors. It's on the side of a bodega, wrapping around a school, transforming a vacant lot into a canvas. This is democratic art at its most powerful.</p>

<h2>From the Streets to the Galleries</h2>

<p>The Mural Arts Philadelphia program, founded in 1984, has catalyzed a movement that now extends far beyond murals. The city's gallery scene — anchored by institutions like the Philadelphia Museum of Art and the Barnes Foundation, but increasingly driven by independent spaces in neighborhoods like Fishtown, Old City, and South Kensington — has become a destination for collectors and curators.</p>

<blockquote><p>"Philadelphia never had to manufacture a cool art scene. It grew organically out of the neighborhoods, out of necessity, out of a city that has always valued making things with your hands."</p><cite>— Jane Golden, Executive Director, Mural Arts Philadelphia</cite></blockquote>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

ART_POST_ID=$(wp post list --post_type=post --post_title="The Mural Capital" --format=ids 2>/dev/null)
if [ -n "$ART_POST_ID" ]; then
    wp post term set "$ART_POST_ID" department_category music-art 2>/dev/null
    echo "  Created: Feature Article - Music & Art (ID: $ART_POST_ID)"
fi

echo ""

# -----------------------------------------------
# 4. Create Blog / Short-Form Posts
# -----------------------------------------------
echo "--- Creating Blog (Short-Form) Posts ---"

# Blog post 1
wp post create --post_type=post --post_status=publish \
    --post_title="5 Things to Do in Philadelphia This Weekend" \
    --post_excerpt="Your quick guide to the best events, openings, and happenings around the city." \
    --post_content="$(cat <<'CONTENT'
<p>Another weekend, another reason to get out and explore this incredible city. Here's our quick rundown of the best things happening in Philadelphia this weekend.</p>

<h2>1. First Friday in Old City</h2>
<p>Galleries open their doors, the streets come alive, and the art flows as freely as the wine. Don't miss the new installation at Paradigm Gallery.</p>

<h2>2. Spruce Street Harbor Park</h2>
<p>The floating gardens and hammocks are back for the season. Grab a local craft beer and watch the sun set over the Delaware.</p>

<h2>3. Reading Terminal Market Saturday</h2>
<p>Get there early for the Amish vendors' fresh-baked goods. The apple dumplings alone are worth the trip.</p>

<h2>4. Wissahickon Valley Hike</h2>
<p>The Forbidden Drive trail is spectacular this time of year. Pack a lunch and make a morning of it.</p>

<h2>5. Live Music at World Cafe Live</h2>
<p>An incredible lineup this weekend featuring three Philly-based bands. Tickets are still available for Saturday's show.</p>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

BLOG1_ID=$(wp post list --post_type=post --post_title="5 Things to Do in Philadelphia This Weekend" --format=ids 2>/dev/null)
if [ -n "$BLOG1_ID" ]; then
    wp post term set "$BLOG1_ID" department_category life 2>/dev/null
    wp post meta update "$BLOG1_ID" _post_layout "blog" 2>/dev/null
    echo "  Created: Blog Post - Weekend Guide (ID: $BLOG1_ID)"
fi

# Blog post 2
wp post create --post_type=post --post_status=publish \
    --post_title="Eagles Preview: What to Watch in the Upcoming Season" \
    --post_excerpt="A quick breakdown of key storylines heading into the new NFL season." \
    --post_content="$(cat <<'CONTENT'
<p>Training camp is underway, and the energy in Philadelphia is electric. Here's what we're watching as the Birds prepare for another run.</p>

<h2>The Offensive Line</h2>
<p>Still one of the best in football, but the depth questions need answers. Watch for the rookie tackles in preseason.</p>

<h2>Secondary Improvements</h2>
<p>Two key free agent signings should shore up a pass defense that struggled late last season. The new defensive coordinator's scheme is already drawing praise.</p>

<h2>Schedule Highlights</h2>
<p>Circle these dates: the home opener, the Dallas rivalry game in Week 9, and a late-season trip to San Francisco that could have playoff implications.</p>

<p>One thing's for sure — this city is ready. Go Birds.</p>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

BLOG2_ID=$(wp post list --post_type=post --post_title="Eagles Preview" --format=ids 2>/dev/null)
if [ -n "$BLOG2_ID" ]; then
    wp post term set "$BLOG2_ID" department_category sports 2>/dev/null
    wp post meta update "$BLOG2_ID" _post_layout "blog" 2>/dev/null
    echo "  Created: Blog Post - Sports (ID: $BLOG2_ID)"
fi

# Blog post 3
wp post create --post_type=post --post_status=publish \
    --post_title="The Best New Coffee Shops in Philadelphia, Ranked" \
    --post_excerpt="We tried every new coffee spot that opened this year. Here are our favorites." \
    --post_content="$(cat <<'CONTENT'
<p>Philadelphia's coffee scene has quietly become one of the best on the East Coast. Here are six new spots that opened this year and immediately became neighborhood favorites.</p>

<p><strong>1. Kindred Spirits (Fishtown)</strong> — A cozy corner shop with single-origin pour-overs and homemade pastries that rival any bakery in the city.</p>

<p><strong>2. The Black Cat (Graduate Hospital)</strong> — Specialty espresso drinks in a beautifully renovated row home. The lavender latte is a must.</p>

<p><strong>3. Morning Ritual (Manayunk)</strong> — Bright, airy, and right on Main Street. Their cold brew is legitimately life-changing.</p>

<p><strong>4. Copper Kettle (West Philadelphia)</strong> — Ethiopian coffee done right, with a small menu of injera wraps that make this a lunch destination too.</p>

<p><strong>5. Page Turner (Northern Liberties)</strong> — Half coffee shop, half used bookstore. The perfect rainy afternoon spot.</p>

<p><strong>6. First Light (Center City)</strong> — Fast, precise espresso for the morning commute crowd. No frills, just excellent coffee.</p>
CONTENT
)" 2>&1 | grep -o 'post [0-9]*' | grep -o '[0-9]*'

BLOG3_ID=$(wp post list --post_type=post --post_title="The Best New Coffee Shops" --format=ids 2>/dev/null)
if [ -n "$BLOG3_ID" ]; then
    wp post term set "$BLOG3_ID" department_category menu 2>/dev/null
    wp post meta update "$BLOG3_ID" _post_layout "blog" 2>/dev/null
    echo "  Created: Blog Post - Coffee Shops (ID: $BLOG3_ID)"
fi

echo ""

# -----------------------------------------------
# 5. Create additional posts for grid population
# -----------------------------------------------
echo "--- Creating Additional Grid Posts ---"

EXTRA_POSTS=(
    "How Fishtown Became Philadelphia's Coolest Neighborhood|life|A look at the decade-long transformation of this once-industrial area."
    "Meet the Woman Behind Philadelphia's Biggest Real Estate Deal|business|CEO Linda Torres just closed a half-billion-dollar waterfront development."
    "Yoga on the Schuylkill: Free Classes Return for Summer|health|Community wellness programs expand along the river trail."
    "Inside the Renovation of a 1920s Brewerytown Row Home|real-estate|Before and after a stunning three-story restoration."
    "Philadelphia's Underground Supper Club Scene|menu|Secret dinners in warehouses, rooftops, and private homes."
    "Street Art Walking Tour: Fishtown to Kensington|music-art|A two-mile route through Philadelphia's most vibrant mural corridor."
    "Brides Guide: Top 10 Wedding Venues in Philadelphia|brides-guide|From historic estates to industrial chic spaces."
    "The Lost Novels of Philadelphia: A Writer's Block Special|writers-block|Rediscovering forgotten literary treasures from the city's past."
    "Fashion Forward: Philadelphia Designers Making National Waves|fashion|Five local designers you need to know right now."
    "Weekend Getaway: Cape May from a Philadelphian's Perspective|travel|Just two hours south, a Victorian beach town awaits."
    "Community Spotlight: The Volunteers of Germantown|people|The unsung heroes keeping this historic neighborhood alive."
    "Flashback: Philadelphia in the 1970s|flashback|Rare photographs capture a city in transformation."
)

for entry in "${EXTRA_POSTS[@]}"; do
    IFS='|' read -r title dept excerpt <<< "$entry"
    wp post create --post_type=post --post_status=publish \
        --post_title="$title" \
        --post_excerpt="$excerpt" \
        --post_content="<p>$excerpt This is placeholder content for the demo. In production, this would contain the full article with rich formatting, images, pull quotes, and embedded media.</p><p>Philadelphia continues to inspire with its unique blend of history, culture, and innovation. From the cobblestone streets of Old City to the vibrant murals of Fishtown, every corner of this city tells a story worth sharing.</p><p>Stay tuned to RowHome Magazine for the latest stories from River to River, One Neighborhood.</p>" \
        2>/dev/null

    POST_ID=$(wp post list --post_type=post --post_title="$title" --format=ids 2>/dev/null)
    if [ -n "$POST_ID" ]; then
        wp post term set "$POST_ID" department_category "$dept" 2>/dev/null
        echo "  Created: $title ($dept)"
    fi
done

echo ""

# -----------------------------------------------
# 6. Create Pictorial (Gallery) Posts
# -----------------------------------------------
echo "--- Creating Pictorial Posts ---"

# Pictorial 1
wp post create --post_type=pictorial --post_status=publish \
    --post_title="Philadelphia in Bloom: Spring Across the City" \
    --post_excerpt="A stunning photo essay capturing cherry blossoms, community gardens, and the rebirth of Philadelphia's green spaces." \
    --post_content="<p>Spring arrives in Philadelphia not all at once, but in waves — first the crocuses pushing through the soil in Rittenhouse Square, then the cherry blossoms along the Schuylkill, and finally the explosion of color in the community gardens of South Philadelphia. This photo essay captures that transformation over six weeks in March and April.</p>" \
    2>/dev/null

PIC1_ID=$(wp post list --post_type=pictorial --post_title="Philadelphia in Bloom" --format=ids 2>/dev/null)
if [ -n "$PIC1_ID" ]; then
    wp post term set "$PIC1_ID" gallery_category neighborhoods 2>/dev/null
    wp post meta update "$PIC1_ID" _pictorial_photographer "Andrew Andreozzi" 2>/dev/null
    wp post meta update "$PIC1_ID" _pictorial_location "Various locations, Philadelphia" 2>/dev/null
    echo "  Created: Pictorial - Spring (ID: $PIC1_ID)"
fi

# Pictorial 2
wp post create --post_type=pictorial --post_status=publish \
    --post_title="Faces of the Italian Market" \
    --post_excerpt="Portraits of the vendors, shoppers, and characters who make 9th Street the most vibrant market in America." \
    --post_content="<p>The Italian Market isn't just a place to buy groceries — it's a living community with stories on every corner. Over three months, photographer James Mitchell captured the faces and moments that define this Philadelphia institution.</p>" \
    2>/dev/null

PIC2_ID=$(wp post list --post_type=pictorial --post_title="Faces of the Italian Market" --format=ids 2>/dev/null)
if [ -n "$PIC2_ID" ]; then
    wp post term set "$PIC2_ID" gallery_category portraits 2>/dev/null
    wp post meta update "$PIC2_ID" _pictorial_photographer "James Mitchell" 2>/dev/null
    wp post meta update "$PIC2_ID" _pictorial_location "9th Street, South Philadelphia" 2>/dev/null
    echo "  Created: Pictorial - Italian Market (ID: $PIC2_ID)"
fi

# Pictorial 3
wp post create --post_type=pictorial --post_status=publish \
    --post_title="Row Homes After Dark: Philadelphia's Architecture by Night" \
    --post_excerpt="A nocturnal exploration of Philadelphia's iconic residential architecture, illuminated by streetlight and moonlight." \
    --post_content="<p>There's a different city that emerges after dark. The row homes that define Philadelphia's residential landscape take on an entirely different character when illuminated by warm window light, vintage street lamps, and the occasional neon sign from a corner bar.</p>" \
    2>/dev/null

PIC3_ID=$(wp post list --post_type=pictorial --post_title="Row Homes After Dark" --format=ids 2>/dev/null)
if [ -n "$PIC3_ID" ]; then
    wp post term set "$PIC3_ID" gallery_category architecture 2>/dev/null
    wp post meta update "$PIC3_ID" _pictorial_photographer "Robert Chen" 2>/dev/null
    wp post meta update "$PIC3_ID" _pictorial_location "Fishtown, Northern Liberties, Graduate Hospital" 2>/dev/null
    echo "  Created: Pictorial - Row Homes at Night (ID: $PIC3_ID)"
fi

# Pictorial 4
wp post create --post_type=pictorial --post_status=publish \
    --post_title="Street Food Stories: A Visual Tour of Philadelphia's Food Carts" \
    --post_excerpt="From halal carts to taco trucks, the flavors of Philadelphia's streets captured in vivid detail." \
    --post_content="<p>Philadelphia's street food scene is as diverse as the city itself. This photo essay takes you on a visual journey through the food carts and trucks that feed the city, from early morning coffee vendors to late-night taco stands.</p>" \
    2>/dev/null

PIC4_ID=$(wp post list --post_type=pictorial --post_title="Street Food Stories" --format=ids 2>/dev/null)
if [ -n "$PIC4_ID" ]; then
    wp post term set "$PIC4_ID" gallery_category food-drink 2>/dev/null
    wp post meta update "$PIC4_ID" _pictorial_photographer "Maria Santos" 2>/dev/null
    wp post meta update "$PIC4_ID" _pictorial_location "Center City, University City, South Philly" 2>/dev/null
    echo "  Created: Pictorial - Street Food (ID: $PIC4_ID)"
fi

echo ""

# -----------------------------------------------
# 7. Create Section Landing Pages
# -----------------------------------------------
echo "--- Creating Section Landing Pages ---"

SECTION_PAGES=("Life|life|Stories about the people and culture of Philadelphia" "Business|business|Commerce, startups, and economic development" "Arts|arts|The creative pulse of Philadelphia" "Lifestyle|lifestyle|Food, travel, events, and hotspots" "Sports|sports|Philadelphia sports coverage and community athletics" "Environment|environment|Sustainability and green living in the city" "Games|games|Puzzles, crosswords, and interactive fun" "People|people|Profiles and interviews with Philadelphians" "Health|health|Wellness, fitness, and healthcare in the city" "Menu|menu|Philadelphia's restaurants, bars, and food scene" "Music & Art|music-art|The creative pulse of Philadelphia" "Real Estate|real-estate|Housing, development, and neighborhood guides")

for entry in "${SECTION_PAGES[@]}"; do
    IFS='|' read -r title slug description <<< "$entry"

    existing=$(wp post list --post_type=page --post_title="$title" --format=count 2>/dev/null)
    if [ "$existing" = "0" ] || [ -z "$existing" ]; then
        wp post create --post_type=page --post_status=publish \
            --post_title="$title" \
            --post_excerpt="$description" \
            --post_content="" \
            2>/dev/null

        PAGE_ID=$(wp post list --post_type=page --post_title="$title" --format=ids 2>/dev/null)
        if [ -n "$PAGE_ID" ]; then
            wp post meta update "$PAGE_ID" _wp_page_template "template-section.php" 2>/dev/null
            wp post meta update "$PAGE_ID" _section_category "$slug" 2>/dev/null
            echo "  Created: Section Page - $title (ID: $PAGE_ID)"
        fi
    else
        echo "  Exists: Section Page - $title"
    fi
done

echo ""

# -----------------------------------------------
# 8. Flush rewrite rules
# -----------------------------------------------
echo "--- Flushing Rewrite Rules ---"
wp rewrite flush 2>/dev/null
echo "  Done."

echo ""
echo "=== Demo Content Creation Complete ==="
echo ""
echo "Summary of created content:"
wp post list --post_type=post --post_status=publish --format=table --fields=ID,post_title,post_date 2>/dev/null
echo ""
echo "Pictorials:"
wp post list --post_type=pictorial --post_status=publish --format=table --fields=ID,post_title 2>/dev/null
echo ""
echo "Section Pages:"
wp post list --post_type=page --post_status=publish --format=table --fields=ID,post_title 2>/dev/null
echo ""
echo "Visit your site at: http://localhost:8882"
echo ""
echo "Template demo URLs:"
echo "  Feature Article: http://localhost:8882/?p=$LIFE_POST_ID"
echo "  Blog Post:       http://localhost:8882/?p=$BLOG1_ID"
echo "  Gallery:         http://localhost:8882/?post_type=pictorial&p=$PIC1_ID"
echo "  Section (Life):  Check the Life section page in your admin"
