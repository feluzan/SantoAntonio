
<div class="col-xs-4 col-lg-3 ticket-card-item">
    <div class="ticket-card-wrapper">
        <div>Refeição: {{ $ticket->refeicao->nome }}</div>
        <div>Assistido: {{ $ticket->assistido->name }}</div>
        <div>Emissor: {{ $ticket->emissor->name }}</div>
        <div>Valor: {{ $ticket->getFormattedValueAttribute() }}</div>
        <div>Usado em {{ $ticket->getFormattedCreatedAtAttribute() }}</div>
    </div>
</div>