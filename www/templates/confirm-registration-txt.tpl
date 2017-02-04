English follows Dutch

--------------------------------------------------------------------------------
Geachte {$registration->buyer()->name|escape:'htmlall'},

We zijn blij te horen dat je interesse hebt in ons evenement. Met deze mail bevestigen wij je reservering.

Je reservering bevat een kaartje {if $registration->buyer()->member}met{else}zonder{/if} lidmaatschap{if $registration->buyer()->vip} en met behandeling als een Sultan{/if}.{if $registration->nguests() > 0} Daarnaast bevat de reservering kaartjes voor {$registration->sguests()}{if $registration->nvips() > 0} waarbij {$registration->svips()} behandeld {if $registration->nvips() == 1}zal{else}zullen{/if} worden als een Sultan{/if}{/if}.

De reservering kan definitief gemaakt worden door € {$registration->sprice()} over te maken naar NL72 ABNA 0455257221 ten name van SDV AmsterDance, onder vermelding van "Gala 2017 - {$registration->buyer()->name|escape:'htmlall'}". 

Mocht je het geld niet hebben overgemaakt voor donderdag 9 februari 23:59, dan gaat je reservering verloren. Natuurlijk kan je dan nog wel een kaartje kopen aan de deur voor € 17,50 (indien er nog kaarten beschikbaar zijn). 
        
Dansende groeten,
Andriy, Helena, Marjolein en Tom
GalaCie Commissie 2016 - 2017
SDV AmsterDance

--------------------------------------------------------------------------------

Dear {$registration->buyer()->name|escape:'htmlall'}, 

We are happy to see that you are interested in our event! With this email we confirm your ticket reservation for the Arabian Nights Gala. To complete your reservation, please transfer € {$registration->sprice()} to NL72 ABNA 0455 2572 21 in the name of SDV AmsterDance with "Gala 2017 - {$registration->buyer()->name|escape:'htmlall'}" as the description.

Your reservation contains a ticket {if $registration->buyer()->member}with{else}without{/if} membership{if $registration->buyer()->vip} and with Sultan treatment{/if}.{if $registration->nguests() > 0} Additionally, your reservation contains tickets for {$registration->sguests()}{if $registration->nvips() > 0} of which {$registration->svips()} shall be treated {if $registration->nvips() == 1}as a Sultan{else}as Sultans{/if}{/if}{/if}.

Please be aware that if you do not transfer the amount before thursday 9th of february 23:59 your reservation will be cancelled. After the cancellation you can still buy a ticket at the door (unless the event is sold out). A ticket at the door will cost € 17,50.

Kind regards,
Andriy, Helena, Marjolein and Tom
GalaCie Commissie 2016 - 2017
SDV AmsterDance

--------------------------------------------------------------------------------
