<div class="schedule-grid">
    @foreach (['segunda', 'terça', 'quarta', 'quinta', 'sexta'] as $dia)
        <div class="schedule-slot">
            <h3>{{ ucfirst($dia) }}</h3>

            @foreach ($campoHorarios->where('dia_semana', $dia) as $slot)
                <div style="margin-bottom: 1rem;">
                    <label>{{ ucfirst($dia) }} - Aula {{ $slot->posicao }}:</label>
                    @php
                        $horario_selecionado = $horarioAtual->get($slot->id);
                    @endphp

                    <select name="alocacoes[{{ $slot->id }}][uc_id]">
                        <option value="">-- UC --</option>
                        @foreach ($ucs as $uc)
                            <option value="{{ $uc->id }}"
                                {{ $horario_selecionado && $horario_selecionado->uc_id == $uc->id ? 'selected' : '' }}>
                                {{ $uc->nome }}
                            </option>
                        @endforeach
                    </select>

                    <select name="alocacoes[{{ $slot->id }}][professor_id]">
                        <option value="">-- Professor --</option>
                        @foreach ($professores as $professor)
                            <option value="{{ $professor->id }}"
                                {{ $horario_selecionado && $horario_selecionado->professor_id == $professor->id ? 'selected' : '' }}>
                                {{ $professor->nome }}
                            </option>
                        @endforeach
                    </select>

                    <select name="alocacoes[{{ $slot->id }}][sala_id]">
                        <option value="">-- Sala --</option>
                        @foreach ($salas as $sala)
                            <option value="{{ $sala->id }}"
                                {{ $horario_selecionado && $horario_selecionado->sala_id == $sala->id ? 'selected' : '' }}>
                                {{ $sala->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
