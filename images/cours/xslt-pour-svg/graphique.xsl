<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:svg="http://www.w3.org/2000/svg"
	xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <xsl:output method="xml" indent="yes"
		media-type="image/xhtml+xml"
        encoding="UTF-8"/>

	<!-- on arrondit la valeur maximum du score
		à la dizaine supérieure -->
    <xsl:variable name="max">
		<xsl:for-each select="//xhtml:tbody/xhtml:tr/xhtml:td[2]">
			<xsl:sort data-type="number" order="descending"/>
			<xsl:if test="position()=1">
				<xsl:value-of select="ceiling(. div 10) * 10"/>
			</xsl:if>
		</xsl:for-each>
	</xsl:variable>

	<!-- nombre de barres -->
	<!-- notez qu’on utilise les espaces de noms dans l’expression XPath -->
	<!-- il ne s’agit pas d’une option, c’est obligatoire et c’est une source d’erreur courrante -->
	<xsl:variable name="nbItems" select="count(//xhtml:tbody/xhtml:tr)"/>

	<!-- taille d’une barre : 30px -->
	<!-- espace entre les barres : 20 px -->
	<xsl:variable name="chartWidth" select="$nbItems * (30 + 20) - 20"/>

	<!-- hauteur du graphique -->
	<xsl:variable name="chartHeight" select="200"/>

	<!-- point en abscisse ou le graphique -->
	<xsl:variable name="chartX" select="20"/>

	<!-- idem pour les ordonnées -->
	<xsl:variable name="chartY" select="50"/>

	<!-- copie de tous les noeuds -->
	<!-- brièvement voici le fonctionnement de XSLT :
		XSLT parcourt tous les noeuds et recopie par défaut le texte.
		On peut changer ce comportement par défaut grâce à des templates.
		Pour chaque noeud, XSLT va choisir le template le plus spécifique à ce noeud
		c’est à dire celui dont l’expression XPath lui correspond le mieux. Il existe des
		règles qui déterminent quel template il faut choisir mais c’est plutôt intuitif.
		Par exemple,
			//tr[position() mod 2 = 0]
		sera choisi contre
			//tr
		pour les <tr/> correspondant (ceux dont la position est paire).
		De même,
			table[@class = 'abc']/tr
		sera choisi contre
			tr
		pour les <tr/> concernés. -->
	<!-- la règle suivante est un règle de copie très générique -->
	<!-- utilisée seule, elle recopie tout le document -->
	<xsl:template match="node() | @*">
		<xsl:copy>
			<xsl:apply-templates select="@* | node()"/>
		</xsl:copy>
	</xsl:template>

	<!-- template plus spécifique qui sera choisi pour <table/> -->
	<!-- cette expression sélectionne tous les <tables/>, c’est un peu
		bourrin mais on peut l’aﬃner -->
    <xsl:template match="//xhtml:table">
		<!-- le contenu de {} est une expression XPath évaluée -->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
			width="50%" height="50%" viewBox="0 0 {$chartWidth + 40} 300">
            <defs>
				<filter id="ombre">
					<feGaussianBlur in="SourceAlpha" stdDeviation="2"/>
					<feOffset dx="2" dy="1"/>
					<feMerge result="image">
						<feMergeNode/>
						<feMergeNode in="SourceGraphic"/>
					</feMerge>
				</filter>

				<linearGradient gradientUnits="userSpaceOnUse" id="deg"
					x1="200" x2="200" y1="{$chartY}" y2="{$chartY + $chartHeight}">
					<stop offset="0%" stop-color="yellowgreen"/>
					<stop offset="100%" stop-color="rgb(220,250,50)"/>
				</linearGradient>
            </defs>

			<script type="text/ecmascript" xlink:href="../../../inc/smil.user.js"/>

			<style><![CDATA[
				.bar:hover rect{
					stroke:black;
					stroke-width:1px;
				}

				text{
					text-anchor:middle;
					}

				text.score{
					font-size:10px;
					font-weight:bold;
					visibility:hidden;
					}

				.bar:hover text.score{
					visibility:visible;
					}
			]]></style>

            <g>
				<!-- sélectionne tous les <tr/> fils de <tbody> fils
					du noeud courant -->
					<!-- le noeud courant est celui sélectionné dans
						xsl:template match="//xhtml:table"> -->
				<xsl:apply-templates select="xhtml:tbody/xhtml:tr"/>
            </g>
        </svg>
    </xsl:template>

	<xsl:template match="xhtml:tbody/xhtml:tr">
		<!-- hauteur de la barre -->
		<xsl:variable name="height" select="xhtml:td[2] div $max * $chartHeight"/>
		<!-- position en abscisse -->
		<xsl:variable name="xPos" select="$chartX + (position() - 1) * (30 + 20)"/>

		<svg:g class="bar">
			<!-- pour plus de facilité, on dessine d’abord les barres vers le bas
				puis on les retourne grâce à l’attribut transform -->
			<svg:rect x="{$xPos}" y="{$chartY}" width="30" height="{$height}" fill="url(#deg)"
				transform="scale(1, -1) translate(0, -300)" filter="url(#ombre)">
				<!-- barre qui montent -->
				<svg:animate attributeName="height" attributeType="XML"
					from="0" to="{$height}"
					begin="0s" dur="{xhtml:td[2] div $max * 1}s"/>
			</svg:rect>

			<svg:text class="score" x="{$xPos + 15}" y="{$chartY + $chartHeight - $height - 6}">
				<xsl:value-of select="xhtml:td[2]"/>
			</svg:text>

			<!-- on utilise ici le modulo pour décaler le texte une fois sur
				deux vers le bas pour éviter le chevauchement -->
			<svg:text x="{$xPos + 15}" y="{$chartY + $chartHeight + 15 + (position() + 1) mod 2 * 18}">
				<xsl:value-of select="xhtml:td[1]"/>
			</svg:text>
		</svg:g>
	</xsl:template>
</xsl:stylesheet>
