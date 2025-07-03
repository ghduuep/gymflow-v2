<?php

namespace App\Services;

use GeminiAPI\Client;
use GeminiAPI\Resources\ModelName;
use GeminiAPI\Resources\Parts\TextPart;
use App\Services\GeneralReportService;
use App\Services\FinancialReportService;

class AiReportService
{

    public function getData(): array {
        $generalReportData = GeneralReportService::getGeneralReport();
        $financialReportData = FinancialReportService::getFinancialReport();

        return array_merge($generalReportData, $financialReportData);
    }

    public function getAiReport()
    {
        $apiKey = config('services.gemini.api_key');
        $data = $this->getData();
        $jsonData = json_encode($data);

        $client = new Client($apiKey);
        $response = $client->withV1BetaVersion()
        ->generativeModel(ModelName::GEMINI_1_5_FLASH)
        ->withSystemInstruction('Você é uma IA especializada em análise financeira e gerencial para negócios esportivos (academias, estúdios de luta, etc). Seu objetivo é fornecer insights acionáveis e recomendações estratégicas aos clientes, com base nos dados financeiros e operacionais fornecidos. Suas análises devem ser: concisa e direta respeitosa e profissional, orientada a resultados (visando a melhora real e sustentável da saúde financeira e eficiência gerencial), e prática e realista (evite sugestões radicais ou que introduzam riscos, priorizando otimizações incrementais). Ao gerar as análises, considere os seguintes pilares: Otimização de Custos, Aumento de Receita, Gestão de Fluxo de Caixa, Eficiência Operacional e Análise de Desempenho. Sua análise final deve ser entregue em um formato claro, priorizando a legibilidade e a implementação das sugestões.')
        ->generateContent(
            new TextPart("Com base nesses arquivos em JSON, gere dicas para o cliente: {$jsonData}"),
        );

        return $response->text();
    }
}